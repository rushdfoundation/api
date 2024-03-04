<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\AttendanceHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentSubmission;
use App\Models\Question;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $assessments = $user->assessments()->paginate(30);
        return response()->json($assessments);
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
                'assessment_id'=>'required',
                'question_id'=>'required',
                'answer_id'=>'required',
                'given_answer'=>'required'
            ]);
            $user = Auth::user();
            AssessmentSubmission::create([
                'user_id'=>$user->id,
                'assessment_id'=>$request->assessment_id,
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
            AttendanceHelper::add($user->id);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homework = Assessment::with('questions.answers')->find($id);
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
