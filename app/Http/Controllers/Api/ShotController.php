<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use FFMpeg;

use App\Models\Shot;

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
        $keyword = $request->query('keyword');
        $genre = $request->query('genre');
        
        $rolesAndGender = $request->query('rolesAndGender');
        $color = $request->query('color');
        $colorSystem = $request->query('colorSystem');
        $timeOfDay = $request->query('timeOfDay');
        $lighting = $request->query('lighting');
        $lightingType = $request->query('lightingType');
        $shotType = $request->query('shotType');
        $cameraAngle = $request->query('cameraAngle');
        $cameraMovement = $request->query('cameraMovement');
        $lensLanguage = $request->query('lensLanguage');
        $aspectRatio = $request->query('aspectRatio');
        $viewpoint = $request->query('viewpoint');
        
        $shots = Shot::when($keyword, function ($query, $keyword) {
            $keyword = explode(' ', $keyword);
            $keyword = is_array($keyword) ? $keyword : [$keyword];
            $len = count($keyword);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('film', 'like', '%'.$keyword[$i].'%')
                    ->orWhere('tags', 'like', '%'.$keyword[$i].'%');
                } else {
                    $query->orWhere('film', 'like', '%'.$keyword[$i].'%')
                    ->orWhere('tags', 'like', '%'.$keyword[$i].'%');
                }
            }
            return $query;
        })
        ->when($genre, function ($query, $genre) {
            $genre = is_array($genre) ? $genre : [$genre];
            $len = count($genre);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('genre', 'like', '%'.$genre[$i].'%');
                } else {
                    $query->orWhere('genre', 'like', '%'.$genre[$i].'%');
                }
            }
            return $query;
        })
        ->when($rolesAndGender, function ($query, $rolesAndGender) {
            $rolesAndGender = is_array($rolesAndGender) ? $rolesAndGender : [$rolesAndGender];
            return $query->whereIn('roles_and_gender', $rolesAndGender);
        })
        ->when($color, function($query, $color) {
            $color = is_array($color) ? $color : [$color];
            return $query->whereIn('color', $color);
        })
        ->when($colorSystem, function($query, $colorSystem) {
            $colorSystem = is_array($colorSystem) ? $colorSystem: [$colorSystem];
            return $query->whereIn('color_system', $colorSystem);
        })
        ->when($timeOfDay, function($query, $timeOfDay) {
            $timeOfDay = is_array($timeOfDay) ? $timeOfDay : [$timeOfDay];
            return $query->whereIn('time_of_day', $timeOfDay);
        })
        ->when($lighting, function($query, $lighting) {
            $lighting = is_array($lighting) ? $lighting : [$lighting];
            return $query->whereIn('lighting', $lighting);
        })
        ->when($lightingType, function($query, $lightingType) {
            $lightingType = is_array($lightingType) ? $lightingType : [$lightingType];
            return $query->whereIn('lighting_type', $lightingType);
        })
        ->when($shotType, function($query, $shotType) {
            $shotType = is_array($shotType) ? $shotType : [$shotType];
            $len = count($shotType);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('shot_type', 'like', '%'.$shotType[$i].'%');
                } else {
                    $query->orWhere('shot_type', 'like', '%'.$shotType[$i].'%');
                }
            }
            return $query;
        })
        ->when($cameraAngle, function($query, $cameraAngle) {
            $cameraAngle = is_array($cameraAngle) ? $cameraAngle : [$cameraAngle];
            $len = count($cameraAngle);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('camera_angle', 'like', '%'.$cameraAngle[$i].'%');
                } else {
                    $query->orWhere('camera_angle', 'like', '%'.$cameraAngle[$i].'%');
                }
            }
            return $query;
        })
        ->when($cameraMovement, function($query, $cameraMovement) {
            $cameraMovement = is_array($cameraMovement) ? $cameraMovement : [$cameraMovement];
            $len = count($cameraMovement);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('camera_movement', 'like', '%'.$cameraMovement[$i].'%');
                } else {
                    $query->orWhere('camera_movement', 'like', '%'.$cameraMovement[$i].'%');
                }
            }
            return $query;
        })
        ->when($lensLanguage, function($query, $lensLanguage) {
            $lensLanguage = is_array($lensLanguage) ? $lensLanguage : [$lensLanguage];
            $len = count($lensLanguage);
            for ($i = 0; $i<$len; $i++) {
                if ($i === 0) {
                    $query->where('lens_language', 'like', '%'.$lensLanguage[$i].'%');
                } else {
                    $query->orWhere('lens_language', 'like', '%'.$lensLanguage[$i].'%');
                }
            }
            return $query;
        })
        ->when($aspectRatio, function($query, $aspectRatio) {
            $aspectRatio = is_array($aspectRatio) ? $aspectRatio : [$aspectRatio];
            return $query->whereIn('aspect_ratio', $aspectRatio);
        })
        ->when($viewpoint, function($query, $viewpoint) {
            $viewpoint = is_array($viewpoint) ? $viewpoint : [$viewpoint];
            return $query->whereIn('viewpoint', $viewpoint);
        })
        ->get();

        return response()->json([
            'shots' => $shots,
        ]);
    }
    
    /**
     * Handle material files upload
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

        // temporary path
        $tempPath = 'temp/shot/' . $now->year . '/' . $now->month;
        // temporary file name
        $tempFullName = $tempPath . '/' . $fileName;
        // temporary partial file name
        $tempPartialFileName = $tempFullName . '.part';

        $config = [
            'ffmpeg.binaries' => config('ffmpeg.ffmpeg'),
            'ffprobe.binaries' => config('ffmpeg.ffprobe'),
            'timeout' => 30000,
            'ffmpeg.threads' => 12,
        ];
        $ffmpeg = FFMpeg\FFMpeg::create($config);
        $ffprobe = $ffmpeg->getFFProbe();

        // file is not been slice
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

        $filmName = trim($request->input('filmName'));
        $fileList = $request->input('fileList');

        $genre = $request->input('genre');
        $genre = $genre ? json_encode($genre, JSON_UNESCAPED_UNICODE) : '';

        $director = trim($request->input('director'));
        $director = $director ? preg_replace($pattern, ' ', $director) : '';
        $director = $director ? json_encode(explode(' ', $director), JSON_UNESCAPED_UNICODE) : '';

        $actors = trim($request->input('actors'));
        $actors = $actors ? preg_replace($pattern, ' ', $actors) : '';
        $actors = $actors ? json_encode(explode(' ', $actors), JSON_UNESCAPED_UNICODE) : '';

        $rolesAndGender = $request->input('rolesAndGender');
        $tags = trim($request->input('tags'));
        $tags = $tags ? preg_replace($pattern, ' ', $tags) : '';
        $tags = $tags ? json_encode(explode(' ', $tags), JSON_UNESCAPED_UNICODE) : '';

        $color = $request->input('color');
        $colorSystem = $request->input('colorSystem');
        $timeOfDay = $request->input('timeOfDay');
        $lighting = $request->input('lighting');
        $lightingType = $request->input('lightingType');
        $shotType = $request->input('shotType');
        $shotType = $shotType ? json_encode($shotType, JSON_UNESCAPED_UNICODE) : '';
        $cameraAngle = $request->input('cameraAngle');
        $cameraAngle = $cameraAngle ? json_encode($cameraAngle, JSON_UNESCAPED_UNICODE) : '';
        $cameraMovement = $request->input('cameraMovement');
        $cameraMovement = $cameraMovement ? json_encode($cameraMovement, JSON_UNESCAPED_UNICODE) : '';
        $lensLanguage = $request->input('lensLanguage');
        $lensLanguage = $lensLanguage ? json_encode($lensLanguage, JSON_UNESCAPED_UNICODE) : '';
        $aspectRatio = $request->input('aspectRatio');
        $viewpoint = $request->input('viewpoint');
        

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

        $shot = new Shot();
        $shot->url = $videoPath ? Storage::url($videoPath) : '';
        $shot->thumbnail = $thumbnailPath ? storage::url($thumbnailPath) : '';
        $shot->film = $filmName;
        $shot->genre = $genre;
        $shot->director = $director;
        $shot->actors = $actors;
        $shot->duration = $duration;
        $shot->roles_and_gender = $rolesAndGender;
        $shot->tags = $tags;
        $shot->color = $color;
        $shot->color_system = $colorSystem;
        $shot->time_of_day = $timeOfDay;
        $shot->aspect_ratio = $aspectRatio;
        $shot->lighting = $lighting;
        $shot->lighting_type = $lightingType;
        $shot->shot_type = $shotType;
        $shot->camera_angle = $cameraAngle;
        $shot->camera_movement = $cameraMovement;
        $shot->lens_language = $lensLanguage;
        $shot->viewpoint = $viewpoint;
        $shot->user_id = 1;
        $shot->save();

        return response()->json([
            'shot' => $shot,
        ]);
    }
}

