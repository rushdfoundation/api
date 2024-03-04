<?php

namespace App\Http\Controllers\Admin\QuestionsBank;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_questions'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_question'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_question'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_question'], ['only' => ['destroy']]);
    }
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Question::query()->paginate(30);
        return response()->json($datas);
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
                'question_text' =>'required',
                'format'=>'required'
            ]);
            $data = Question::create([
                'question_text'=> $request->question_text,
                'format' => $request->format,
                'type' => $request->type,
                'audio_path' =>$request->audio_path,
                'classroom_id'=>$request->classroom_id,
                'course_id'=>$request->course_id,
            ]);
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Question::with('answers')->find($id);
        return response()->json($data);
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
                'question_text' =>'required',
                'format'=> 'required'
            ]);
            $data = Question::find($id);
            $data = $data->update([
                'question_text'=> $request->question_text,
                'format' => $request->format,
                'type' => $request->type,
                'audio_path' =>$request->audio_path,
                'classroom_id'=>$request->classroom_id,
                'course_id'=>$request->course_id,
            ]);
            return response()->json($data);
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
            $data = Question::find($id);
            $data->delete();
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
