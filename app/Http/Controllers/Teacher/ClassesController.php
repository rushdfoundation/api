<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function __invoke()
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $teacher = Teacher::where('user_id',Auth::id())->first();
           
            $classrooms = DB::table('subjects')
            ->join('classrooms', 'classrooms.id', '=', 'subjects.classroom_id')
            ->where('subjects.teacher_id', $teacher->id)
            ->select('classrooms.*')
            ->distinct()
            ->get();

            return response()->json($classrooms);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $teacher = Teacher::where('user_id',Auth::id())->first(); 
            $subjects = DB::table('subjects')
            ->where('teacher_id', $teacher->id)
            ->where('classroom_id', $id)
            ->get();
            return response()->json($subjects);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
