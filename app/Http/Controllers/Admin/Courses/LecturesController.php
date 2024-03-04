<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Exception;
use Illuminate\Http\Request;

class LecturesController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_lectures'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_lecture'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_lecture'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_lecture'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Lecture::query()->paginate(30);
        return response()->json($classes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'title'=>'required',
                'description'=>'required',
                'course_id'=>'required',
            ]);
            $lecture = Lecture::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'course_id' =>$request->course_id
            ]);
            return response()->json($lecture);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'title'=>'required',
                'description'=>'required',
                'course_id'=>'required',
            ]);
            $lecture =  Lecture::find($id);
            $lecture->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'course_id' =>$request->course_id
            ]);
            return response()->json($lecture);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $lecture = Lecture::find($id);
            $lecture->delete();
            return response()->json($lecture);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
