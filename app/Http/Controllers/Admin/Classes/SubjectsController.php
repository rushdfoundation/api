<?php

namespace App\Http\Controllers\Admin\Classes;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_subjects'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_subject'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_subject'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_subject'], ['only' => ['destroy']]);
    }
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::query()->paginate(30);
        return response()->json($subjects);
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
                'name'=>'required',
                'classroom_id'=>'required',
            ]);
            $subject = Subject::create([
                'name'=>$request->name,
                'classroom_id'=>$request->classroom_id,
            ]);
            return response()->json($subject);
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
                'name'=>'required',
                'classroom_id'=>'required',
            ]);
            $subject =  Subject::find($id);
            $subject->update([
                'name'=>$request->name,
                'classroom_id'=>$request->classroom_id,
            ]);
            return response()->json($subject);
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
            $subject = Subject::find($id);
            $subject->delete();
            return response()->json($subject);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
