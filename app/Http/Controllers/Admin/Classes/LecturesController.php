<?php

namespace App\Http\Controllers\Admin\Classes;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Exception;
use Illuminate\Http\Request;

class LecturesController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_lectures'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_lecture'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_lecture'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_lecture'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = Lecture::query()->orderBy('created_at','DESC')->paginate(30);
        }else{
            $data = Lecture::where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
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
                'title'=>'required',
                'description'=>'required',
                'subject_id'=>'required',
                'school_id'=>'required'
            ]);
            $lecture = Lecture::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'subject_id' =>$request->subject_id,
                'school_id'=>$request->school_id,
            ]);
            return response()->json($lecture);
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
                'title'=>'required',
                'description'=>'required',
                'subject_id'=>'required',
            ]);
            $lecture =  Lecture::find($id);
            $lecture->title = $request->title;
            $lecture->description = $request->description;
            $lecture->subject_id = $request->subject_id;
            $lecture->update();
            return response()->json($lecture);
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
            $lecture = Lecture::find($id);
            $lecture->delete();
            return response()->json($lecture);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
