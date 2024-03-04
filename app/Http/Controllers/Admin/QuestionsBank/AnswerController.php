<?php

namespace App\Http\Controllers\Admin\QuestionsBank;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use Exception;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
        $ansers = Answer::query()->paginate(30);
        return response()->json($ansers);
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
                'question_id' =>'required',
                'answer_text' => 'required',
                'is_correct' => 'required',
            ]);
            $anser = Answer::create($request->all());
            return response()->json($anser);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anser = Answer::find($id);
        return response()->json($anser);
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
                'quesion_id' =>'required',
                'answer_text' => 'required',
                'is_correct' => 'required',
            ]);
            $anser = Answer::find($id);
            $anser = $anser->update([
                'quesion_id'=> $request->quesion_id,
                'answer_text' => $request->answer_text,
                'is_correct' => $request->is_correct
            ]);
            return response()->json($anser);
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
            $anser = Answer::find($id);
            $anser->delete();
            return response()->json($anser);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
