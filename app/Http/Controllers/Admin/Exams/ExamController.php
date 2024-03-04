<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Helpers\ExceptionHelper;
use App\Helpers\NoticBoardHelper;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_exams'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_exam'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_exam'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_exam'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::paginate(30);
        return response()->json($exams);
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
                'name' =>'required',
                'description' => 'required',
                'date' => 'required',
                'type'=> 'required'
            ]);
            $exam = Exam::create($request->all());
            $notice = [
                'title'=>$request->name,
                'description'=>$request->description,
                'link'=>'https://rushd.ngo'
            ];
            NoticBoardHelper::add($notice);
            return response()->json($exam);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exam::with('examResults','questions.answers')->find($id);
        return response()->json($exam);
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
                'name' =>'required',
                'description' => 'required',
                'date' => 'required',
                'type'=> 'required'
            ]);
            $exam = Exam::find($id);
            $exam = $exam->update([
                'name'=> $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'type' => $request->type,
            ]);
            $notice = [
                'title'=>$request->name,
                'description'=>$request->description,
                'link'=>'https://rushd.ngo'
            ];
            NoticBoardHelper::edit($notice,1);
            return response()->json($exam);
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
            $exam = Exam::find($id);
            $exam->delete();
            return response()->json($exam);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    public function addQuestion(Request $request){
        try{
            $request->validate([
                'exam_id'=>'required',
                'question_id'=>'required|array'
            ]);
            $exam = Exam::find($request->input('exam_id'));
            $exam->questions()->attach($request->input('question_id'));
            return response()->json($exam);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
    public function removeQuestion(Request $request){
        try{
            $request->validate([
                'exam_id'=>'required',
                'question_id'=>'required|array'
            ]);
            $exam = Exam::find($request->input('exam_id'));
            $exam->questions()->detach($request->input('question_id'));
            return response()->json($exam);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
