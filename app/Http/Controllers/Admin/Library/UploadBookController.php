<?php

namespace App\Http\Controllers\Admin\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadBookController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:upload_file'], ['only' => ['upload', 'remove']]);
    }

    public function upload(Request $request){
        if ($request->hasFile('book')) {
            $file = $request->file('book');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = 'public/files/books'. $file_name;
            
            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "book"
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
