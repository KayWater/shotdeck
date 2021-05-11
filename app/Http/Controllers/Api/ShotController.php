<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;

use FFMpeg;

use App\Models\Shot;
use App\Models\Tag;
use App\Models\Movie;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\OldShot;
use App\Models\Person;

class ShotController extends Controller
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
        $pattern = "/\s+/i";
        $keyword = trim($request->input('keyword'));
        $keyword = $keyword ? preg_replace($pattern, ' ', $keyword) : '';
        $movieId = $request->query('movieId');

        $genre = $request->query('genre');

        $filters = json_decode($request->query('filters'), JSON_OBJECT_AS_ARRAY);

        $limit = $request->query('limit', 20);
        $offset = $request->query('offset', 0);
        
        $shots = Shot::when($keyword, function ($query, $keyword) {
            $keyword = explode(' ', $keyword);
            $keyword = is_array($keyword) ? $keyword : [$keyword];
            $len = count($keyword);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $moviesHasKeyword = Movie::where('name', 'like', '%'.$keyword[$i].'%')->get();
                    $query->whereIn('movie_id', $moviesHasKeyword->pluck('id'))
                        ->orWhereHas('tags', function(Builder $query) use ($keyword, $i) {
                            $query->where('name', 'like', '%'.$keyword[$i].'%');
                        });
                } else {
                    $moviesHasKeyword = Movie::where('name', 'like', '%'.$keyword[$i].'%')->get();
                    $query->orWhereIn('movie_id', $moviesHasKeyword->pluck('id'))
                        ->orWhereHas('tags', function(Builder $query) use ($keyword, $i) {
                            $query->where('name', 'like', '%'.$keyword[$i].'%');
                        });
                }
            }
            return $query;
        })
        ->when($genre, function ($query, $genre) {
            if (is_array($genre)) {
                $movies = Movie::whereHas('genres', function(Builder $query) use ($genre) {
                    $query->whereIn('id', $genre);
                })->get();
            } else {
                $movies = Movie::whereHas('genres', function(Builder $query) use ($genre) {
                    $query->where('id', $genre);
                })->get();
            } 
            return $query->whereIn('movie_id', $movies->pluck('id'));
        })
        ->when($filters, function($query, $filters) {
            foreach($filters as $key => $values) {
                $query->where(function ($query) use ($key, $values) {
                    foreach($values as $index => $value) {
                        if ($index == 0) {
                            $query->whereJsonContains('attributes->'.$key, $value);
                        } else {
                            $query->orWhereJsonContains('attributes->'.$key, $value);
                        }
                    }
                });
            }
        })->when($movieId, function($query, $movieId) {
            return $query->where('movie_id', $movieId);
        })
        ->limit($limit)->offset($offset)
        ->orderBy('created_at', 'desc')->get();

        return response()->json([
            'shots' => $shots,
        ]);
    }
    
    /**
     * Handle shot files upload
     * 
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function upload(Request $request)
    {
        $fileName = $request->input('fileName');
        $fileChunk = $request->file('fileChunk'); // The chunk of file
        $chunkCount = intval($request->input('chunkCount')); // The count the file slice into
        $chunkIndex = intval($request->input('chunkIndex')); // Then index of current chunk

        $now = Carbon::now();

        // 临时存储目录
        $tempPath = 'temp/shot/' . $now->year . '/' . $now->month;

        // 目录不存在
        if ( ! Storage::disk('public')->exists($tempPath) ) {
            Storage::disk('public')->makeDirectory($tempPath);
        }

        // 临时存储文件名加目录
        $tempFullName = $tempPath . '/' . $fileName;
        // 临时分块文件名加目录
        $tempPartialFileName = $tempFullName . '.part';

        $config = [
            'ffmpeg.binaries' => config('ffmpeg.ffmpeg'),
            'ffprobe.binaries' => config('ffmpeg.ffprobe'),
            'timeout' => 30000,
            'ffmpeg.threads' => 12,
        ];
        $ffmpeg = FFMpeg\FFMpeg::create($config);
        $ffprobe = $ffmpeg->getFFProbe();

        // 未分块
        if ($chunkCount === 1) {
            $mimeType = $fileChunk->getMimeType();

            // Check the mime type of the file whether allowed with the material type
            $isAllowed = in_array($mimeType, Shot::ALLOWED_MIMETYPES);

            if (!$isAllowed) {
                return response()->json([
                    'message' => "Not allowed file type!",
                ], 400);
            }

            // put file to temporary direction
            $path = Storage::disk('public')->putFileAs($tempPath, $fileChunk, $fileName);

            // Open the video
            $video = $ffmpeg->open(public_path(Storage::url($tempFullName)));
            // Get the frame from first seconds
            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(0));

            // Get the video duration
            $duration = $ffprobe->format(public_path(Storage::url($tempFullName)))->get('duration');
            $duration = intval($duration);

            $basename = File::basename(public_path(Storage::url($tempFullName)));
            $extension = File::extension(public_path(Storage::url($tempFullName)));
            $framePath = $tempPath . '/' . strstr($basename, $extension, true) . 'jpg';
            $frame->save(storage_path('/app/public/' . $framePath));

            return response()->json([
                'name' => $fileName,
                'path' => Storage::url($path),
                'thumbnail' => Storage::url($framePath),
                'duration' => $duration,
            ]);
        } else {
            // Append the chunk to partial file
            // Storage::disk('public')->append($tempPartialFileName, $fileChunk->get());
            // 注意 Storage::append() 会导致二进制文件错误
            File::append(
                public_path(Storage::url($tempPartialFileName)), 
                $fileChunk->get());
            
            // the last chunk has been upload
            if ($chunkIndex + 1 == $chunkCount) {

                if (Storage::disk('public')->exists($tempFullName)) {
                    Storage::disk('public')->delete($tempFullName);
                }
                // rename
                Storage::disk('public')->move($tempPartialFileName, $tempFullName);
              
                $mimeType = File::mimeType(public_path(Storage::url($tempFullName)));
                // Check the mime type of the file whether allowed with the material type
                $isAllowed = in_array($mimeType, Shot::ALLOWED_MIMETYPES);

                if (!$isAllowed) {
                    return response()->json([
                        'message' => "Not allowed file type!",
                    ], 400);
                }

                // Open the video
                $video = $ffmpeg->open(public_path(Storage::url($tempFullName)));
                // Get the frame from first seconds
                $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(0));

                // Get the video duration
                $duration = $ffprobe->format(public_path(Storage::url($tempFullName)))->get('duration');
                $duration = intval($duration);

                $basename = File::basename(public_path(Storage::url($tempFullName)));
                $extension = File::extension(public_path(Storage::url($tempFullName)));
                $framePath = $tempPath . '/' . strstr($basename, $extension, true) . 'jpg';
                $frame->save(storage_path('/app/public/' . $framePath));

                return response()->json([
                    'name' => $fileName,
                    'path' => Storage::url($tempFullName),
                    'thumbnail' => Storage::url($framePath),
                    'duration' => $duration,
                ]);
            }
            
            return response()->json([
                'name' => $fileName,
                'path' => $tempPartialFileName,
            ]);
        }
    }

    public function store(Request $request)
    {
        $pattern = "/\s+/i";

        $movieId = $request->input('movieId');
        $fileList = $request->input('fileList');
        $file = $fileList[0];
        $url = $file['url'];
        $thumbnail = $file['thumbnail'];
        $duration = $file['duration'];

        $actors = $request->input('actors');

        $attributes = $request->input('attributes');

        // Move picture file to actually storage
        $now = Carbon::now();
        // temporary path
        $path = 'upload/shot/' . $now->year . '/' . $now->month;
        $videoPath = $url ? Storage::disk('public')->putFile($path, 
            new \Illuminate\Http\File(public_path($url))) : '';
        $thumbnailPath = $thumbnail ? Storage::disk('public')->putFile($path, 
            new \Illuminate\Http\File(public_path($thumbnail))) : '';

        $shot = new Shot();
        $shot->url = $videoPath ? Storage::url($videoPath) : '';
        $shot->thumbnail = $thumbnailPath ? storage::url($thumbnailPath) : '';
        $shot->movie_id = $movieId;
        // $shot->attributes = json_encode($attributes, JSON_UNESCAPED_UNICODE);
        // 在Model中设置 $casts 属性后 Laravel 会自动将 $attributes 转换为JSON格式
        $shot->attributes = $attributes;
        $shot->duration = $duration;
        $shot->user_id = 1;
        $shot->save();

        $shot->people()->attach($actors);

        $tags = trim($request->input('tags'));
        $tags = $tags ? preg_replace($pattern, ' ', $tags) : '';
        $tags = explode(' ', $tags);
        $tagItems = [];
        foreach($tags as $tag) {
            $tagItem = Tag::firstOrNew(['name' => $tag]);
            if (!$tagItem->exist) {
                $tagItem->name = $tag;
                $tagItem->status = 0;
                $tagItem->save();
            }
            array_push($tagItems, $tagItem->id);
        }

        $shot->tags()->attach($tagItems);

        return response()->json([
            'shot' => $shot,
        ]);
    }

    public function destroy(Request $request, $id) 
    {
        $shot = Shot::findOrFail($id);

        $videoFile = $shot->url;
        $thumbnailFile = $shot->thumbnail;

        //删除文件
        File::delete(public_path($videoFile));
        File::delete(public_path($thumbnailFile));

        $shot->people()->detach();
        $shot->tags()->detach();

        $shot->delete();

        return response()->json([
            'shot' => $shot
        ]);
    }

    public function show(Request $request, $id) 
    {

        $shot = Shot::findOrFail($id);

        $attributes = $shot->attributes;
        $attributesStr = [];
        foreach($attributes as $key => $values) {
            $property = Property::select('id', 'name')->with(['values' => function($query) use ($values) {
                $isMulti = is_array($values);
                $query->select('id', 'property_id', 'name')->when($isMulti, function($query) use ($values) {
                    return $query->whereIn('id', $values);
                }, function($query) use ($values) {
                    return $query->where('id', $values);
                });
            }])->where('id', $key)->first();
            if ($property->exists) {
                array_push($attributesStr, $property);
            }
        }

        $shot->load(['movie' => function($query) {
            $query->with(['people' => function ($query) {
                $query->wherePivot('role_type', Movie::MOVIE_DIRECTOR);
            }])->with('genres');
        }]);

        $shot->load('people');
        $shot->load('tags');

        $shot->attributes_str = $attributesStr;

        return response()->json([
            'shot' => $shot
        ]);
    }

    public function update(Request $request, $id) 
    {
        $pattern = "/\s+/i";
        $shot = Shot::findOrFail($id);
        $movieId = $request->input('movieId');
        $fileList = $request->input('fileList');

        $actors = $request->input('actors');

        $attributes = $request->input('attributes');

        if ($fileList) {
            $file = $fileList[0];
            $url = $file['url'];
            $thumbnail = $file['thumbnail'];
            $duration = $file['duration'];

            // Move picture file to actually storage
            $now = Carbon::now();
            // temporary path
            $path = 'upload/shot/' . $now->year . '/' . $now->month;

            $videoPath = $url ? Storage::disk('public')->putFile($path, 
                new \Illuminate\Http\File(public_path($url))) : '';
            $thumbnailPath = $thumbnail ? Storage::disk('public')->putFile($path, 
                new \Illuminate\Http\File(public_path($thumbnail))) : '';

            $shot->url = $videoPath ? Storage::url($videoPath) : '';
            $shot->thumbnail = $thumbnailPath ? storage::url($thumbnailPath) : '';

            $shot->duration = $duration;
        }

        $shot->movie_id = $movieId;
        //  $shot->attributes = json_encode($attributes, JSON_UNESCAPED_UNICODE);
        // 在Model中设置 $casts 属性后 Laravel 会自动将 $attributes 转换为JSON格式
        $shot->attributes = $attributes;

        $shot->user_id = 1;
        $shot->save();

        $shot->people()->sync($actors);

        $tags = trim($request->input('tags'));
        $tags = $tags ? preg_replace($pattern, ' ', $tags) : '';
        $tags = explode(' ', $tags);
        $tagItems = [];
        foreach($tags as $tag) {
            $tagItem = Tag::firstOrNew(['name' => $tag]);
            if (!$tagItem->exist) {
                $tagItem->name = $tag;
                $tagItem->status = 0;
                $tagItem->save();
            }
            array_push($tagItems, $tagItem->id);
        }

        $shot->tags()->sync($tagItems);

        return response()->json([
            'shot' => $shot
        ]);
    }
    
}

