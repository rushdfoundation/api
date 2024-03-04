<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Homework;
use Exception;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $res = Homework::created([
                'title' => $request->title,
                'lecture_id' => $request->lecture_id,
                'description' => $request->description,
                'deadline' => $request->deadline
            ]);
            return response()->json($res);
        }catch(Exception $e){
            return response()->json([
                'message'=>'Faild to submit.',
                'errors' => $e->getMessage(),
            ],400);
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
            $ass = Homework::find($id);
            $res = $ass->update([
                'title' => $request->title,
                'lecture_id' => $request->lecture_id,
                'description' => $request->description,
                'deadline' => $request->deadline
            ]);
            return response()->json($res);
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
            $ass = Homework::find($id);
            $ass->delete();
            return response()->json($ass);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
