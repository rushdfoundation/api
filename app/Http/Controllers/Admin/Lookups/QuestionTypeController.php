<?php

namespace App\Http\Controllers\Admin\Lookups;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\QuestionType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionTypeController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_lookups'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_lookup'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_lookup'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_lookup'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = QuestionType::query()->orderBy('created_at','DESC')->paginate(30);
        }else{
            $data = QuestionType::where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
        }
        return response()->json($data);
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
                'name'=> 'required',
                'school_id'=>'required',
            ]);
            $data=QuestionType::create($request->all());
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
                'name'=> 'required',
            ]);
            $type = QuestionType::find($id);
            $type->name = $request->name;
            $type->update();
            return response()->json($type);
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
            $data = QuestionType::find($id);
            $data->delete();
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
