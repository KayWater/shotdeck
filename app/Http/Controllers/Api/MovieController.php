<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;

use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $limit = $request->query('limit', 20);
        $offset = $request->query('offset', 0);
        $genre = $request->query('genre');
        $region = $request->query('region');
        $year = $request->query('year');

        $movies = Movie::when($genre, function($query, $genre) {
            return $query->whereHas('genres', function($query) use ($genre) {
                $query->where('genre_id', $genre);
            });
        })->when($region, function($query, $region) {
            return $query->whereHas('regions', function($query) use ($region) {
                $query->where('region_id', $region);
            });
        })->when($year, function($query, $year) {
            $years = explode('-', $year);
            sort($years, SORT_NUMERIC);
            if (count($years) === 1) {
                return $query->whereYear('release_time', $years[0]);
            } else {
                return $query->whereYear('release_time', '>=', $years[0])
                    ->whereYear('release_time', '<=', $years[1]);
            }
        })
        ->limit($limit)->offset($offset)
        ->orderBy('created_at', 'desc')->get();

        return response()->json([
            'movies' => $movies,
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $nameEn = $request->input('nameEn');
        $posterUrl = $request->input('posterUrl');
        $genres = $request->input('genres');
        $regions = $request->input('regions');
        $directors = $request->input('directors');
        $actors = $request->input('actors');
        $intro = $request->input('intro');
        $duration = $request->input('duration');
        $releaseTime = $request->input('releaseTime');
        $shotCount = $request->input('shotCount');

        // 同名且上映时间相同，则为同一部电影
        $movie = Movie::where('name', $name)
            ->where('release_time', $releaseTime)
            ->firstOrNew();
        if ($movie->exists) {
            return response()->json([
                'message'=> '系统已有相同电影，请勿重复添加',
            ], 400);
        }

        // Move picture file to actually storage
        $now = Carbon::now();
        $path = 'upload/movies/' . $now->year . '/' . $now->month;
        $posterUrl = $posterUrl ? Storage::disk('public')->putFile($path, 
            new \Illuminate\Http\File(public_path($posterUrl))) : '';

        $movie->name = $name;
        $movie->name_en = $nameEn;
        $movie->poster_url = $posterUrl;
        $movie->intro = $intro;
        $movie->duration = $duration;
        $movie->release_time = $releaseTime;
        $movie->shot_count = $shotCount;

        $movie->save();

        $movie->genres()->attach($genres);
        $movie->regions()->attach($regions);


        $people = array();
        foreach( $directors as $director) {
            $people[$director] = [ 
                    'role_type' => Movie::MOVIE_DIRECTOR
            ];
        }

        foreach( $actors as $actor) {
            $people[$actor['id'][0]] = [
                'role_type' => $actor['type'],
                'character' => $actor['name'],
                'character_description' => $actor['description'],
            ];
        }
        $movie->people()->attach($people);

        $movie->load('regions', 'genres', 'people');

        return response()->json([
            'movie' => $movie
        ]);
    }

    public function show(Request $request, $id) 
    {
        $movie = Movie::with('people:id,name', 'genres:id,name', 'regions:id,name')->findOrFail($id);

        return response()->json([
            'movie' => $movie
        ]);
    }

    public function update(Request $request, $id) 
    {
        $movie = Movie::findOrFail($id);

        $name = $request->input('name');
        $nameEn = $request->input('nameEn');
        $posterUrl = $request->input('posterUrl');
        $genres = $request->input('genres');
        $regions = $request->input('regions');
        $directors = $request->input('directors');
        $actors = $request->input('actors');
        $intro = $request->input('intro');
        $duration = $request->input('duration');
        $releaseTime = $request->input('releaseTime');
        $shotCount = $request->input('shotCount');

        // 同名且上映时间相同，则为同一部电影
        $sameMovie = Movie::where('name', $name)
            ->where('release_time', $releaseTime)
            ->where('id', '!=', $id)
            ->firstOrNew();
        if ($sameMovie->exists) {
            return response()->json([
                'message'=> '系统已有相同电影，请勿重复添加',
            ], 400);
        }

        if ($posterUrl != 'storage/' . $movie->poster_url) {
            // Move picture file to actually storage
            $now = Carbon::now();
            $path = 'upload/movies/' . $now->year . '/' . $now->month;
            $posterUrl = $posterUrl ? Storage::disk('public')->putFile($path, 
                new \Illuminate\Http\File(public_path($posterUrl))) : '';

            $movie->poster_url = $posterUrl;
        }

        $movie->name = $name;
        $movie->name_en = $nameEn;
        $movie->intro = $intro;
        $movie->duration = $duration;
        $movie->release_time = $releaseTime;
        $movie->shot_count = $shotCount;

        $movie->save();

        $movie->genres()->sync($genres);
        $movie->regions()->sync($regions);

        $people = array();
        foreach( $directors as $director) {
            $people[$director] = [ 
                    'role_type' => Movie::MOVIE_DIRECTOR
            ];
        }

        foreach( $actors as $actor) {
            $people[$actor['id'][0]] = [
                'role_type' => $actor['type'],
                'character' => $actor['name'],
                'character_description' => $actor['description'],
            ];
        }
        $movie->people()->sync($people);

        $movie->load('regions', 'genres', 'people');

        return response()->json([
            'movie' => $movie
        ]);
    }
    public function search(Request $request)
    {

    }

    public function uploadPoster(Request $request) 
    {
        $file = $request->file('file'); // The chunk of file
        $now = Carbon::now();

        // 临时存储目录
        $tempPath = 'temp/movies/' . $now->year . '/' . $now->month;

        // 目录不存在
        if ( ! Storage::disk('public')->exists($tempPath) ) {
            Storage::disk('public')->makeDirectory($tempPath);
        }

        $mimeType = $file->getMimeType();

        // Check mime type of the file 
        $isAllowed = in_array($mimeType, Movie::ALLOWED_MIMETYPES);

        if (!$isAllowed) {
            return response()->json([
                'message' => "Not allowed file type!",
            ], 400);
        }
        // put file to temporary direction
        $path = Storage::disk('public')->putFile($tempPath, $file);


        return response()->json([
            'url' => Storage::url($path)
        ]);
    }

    public function getActors(Request $request, $id)
    {
        $movie = Movie::with(['people' => function ($query) {
            $query->wherePivot('role_type', '!=', Movie::MOVIE_DIRECTOR);
        }])->findOrFail($id);

        $actors = $movie->people;

        return response()->json([
            'actors' => $actors,
        ]);
    }

}