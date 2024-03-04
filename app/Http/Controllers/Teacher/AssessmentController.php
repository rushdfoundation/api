<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Exception;
use Illuminate\Http\Request;

class AssessmentController extends Controller
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
            $res = Assessment::created([
                'title' => $request->title,
                'lecture_id' => $request->lecture_id,
                'description' => $request->description
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
            $ass = Assessment::find($id);
            $res = $ass->update([
                'title' => $request->title,
                'lecture_id' => $request->lecture_id,
                'description' => $request->description
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
        $ass = Assessment::find($id);
        $ass->delete();
        return response()->json($ass);
    }
}
