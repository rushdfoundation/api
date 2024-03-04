<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('homework')) {
            $file = $request->file('homework');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/homeworks'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "homework"
            ]);
        }
        if ($request->hasFile('lecture')) {
            $file = $request->file('lecture');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/lectures'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "lecture"
            ]);
        }
        if ($request->hasFile('comment')) {
            $file = $request->file('comment');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/comments'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "comment"
            ]);
        }
        if ($request->hasFile('library')) {
            $file = $request->file('library');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/library'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "library"
            ]);
        }
        if ($request->hasFile('exam')) {
            $file = $request->file('exam');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/exams'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "exam"
            ]);
        }
        
    }
 
    public function remove(Request $request){
        if(Storage::exists($request->path)){
            Storage::delete($request->path);
            return response()->json("Removed an image");
        }else{
            return response()->json("Image not found");
        }
        return response()->json("Removed an image");
    }
}
