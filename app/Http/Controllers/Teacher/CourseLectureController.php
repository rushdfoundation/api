<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseLectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lectures = Lecture::where('course_id',$request->id)->get();
        return response()->json($lectures);
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
                'title' => 'required',
                'description'=>'required',
                'course_id'=>'required',
                'school_id'=>'required'
            ]);
            $res = Lecture::create([
                'title' => $request->title,
                'description'=> $request->description,
                'course_id' => $request->course_id,
                'school_id'=>$request->school_id,
            ]);
            return response()->json($res);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lecture = Lecture::with(['comments.user' => function ($query) {
            $query->select('id', 'name', 'avatar');
        }])->find($id);
        return response()->json($lecture);
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
                'title' => 'required',
                'description'=>'required'
            ]);
            $lec = Lecture::find($id);
            $lec->title = $request->title;
            $lec->description = $request->description;
            $lec->update();
            return response()->json($lec);
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
            $lec = Lecture::find($id);
            $lec->delete();
            return response()->json($lec);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
