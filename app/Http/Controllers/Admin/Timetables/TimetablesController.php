<?php

namespace App\Http\Controllers\Admin\Timetables;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Timetable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimetablesController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_timetables'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_timetable'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_timetable'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_timetable'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = Timetable::query()->orderBy('created_at','DESC')->paginate(30);
        }else{
            $data = Timetable::where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
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
                'day' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'teacher_id' => 'required',
                'school_id' => 'required',
                'course_id' => 'required_without:classroom_id', // Required if classroom_id is not provided
                'classroom_id' => 'required_without:course_id', // Required if course_id is not provided
                'subject_id' => 'required_if:classroom_id,!=,null'
            ]);

            $time = Timetable::create([
                'classroom_id'=>$request->classroom_id,
                'subject_id'=>$request->subject_id,
                'course_id'=>$request->course_id,
                'teacher_id'=>$request->teacher_id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'school_id' =>$request->school_id,
            ]);
            return response()->json($time);
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
                'day' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'teacher_id' => 'required',
            ]);
            $time = Timetable::find($id);
            $time->classroom_id= $request->classroom_id;
            $time->subject_id =$request->subject_id;
            $time->course_id =$request->course_id;
            $time->teacher_id = $request->teacher_id;
            $time->day =$request->day;
            $time->start_time=  $request->start_time;
            $time->end_time =$request->end_time;
            $time->update();
            return response()->json($time);
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
            $time = Timetable::find($id);
            if(!$time){
                throw new Exception("Not found",404);
            }
            $time->delete();
            return response()->json($time);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
