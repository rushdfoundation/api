<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Question;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return response()->json($user->homeworks);
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
                'homework_id'=>'required',
                'question_id'=>'required',
                'answer_id'=>'required',
                'given_answer'=>'require'
            ]);
            $user = Auth::user();
            HomeworkSubmission::create([
                'user_id'=>$user->id,
                'homework_id'=>$request->homework_id,
                'question_id'=>$request->question_id,
                'answer_id'=>$request->answer_id,
                'given_answer'=>$request->given_answer,
                'type' => Question::find($request->question_id)->type
            ]);
            $activity = [
                'title' => "Homework",
                'description' => "Homework submitted.",
                'link' => "student/homework",
                'user_id' => $user->id,
                'classroom_id' => null,
                'course_id' => null,
            ];
            ActivityHelper::add($activity);
            return response()->json($activity);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homework = Homework::with('questions.answers')->find($id);
        return response()->json($homework);
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
