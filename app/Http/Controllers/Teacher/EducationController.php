<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Education;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
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
            $request->validate([
                'level'=>'required',
                'location'=>'required',
                'graduation_year'=>'required',
                'center'=> 'required'
            ]);
            $education = Education::create([
                'level'=>$request->level,
                'location'=>$request->location,
                'graduation_year'=>$request->graduation_year,
                'center' => $request->center,
                'user_id' => Auth::id()
            ]);
            return response()->json($education);
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
                'leval'=>'required',
                'location'=>'required',
                'graduation_year'=>'required',
                'center'=> 'required'
            ]);
    
            $education = Education::find($id);
            $education->update([
                'level'=>$request->level,
                'location'=>$request->location,
                'graduation_year'=>$request->graduation_year,
                'center' => $request->center,
            ]);
            return response()->json($education);
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
            $education = Education::find($id);
            $education->delete();
            return response()->json($education);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
