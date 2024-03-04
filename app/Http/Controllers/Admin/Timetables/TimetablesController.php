<?php

namespace App\Http\Controllers\Admin\Timetables;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Timetable;
use Exception;
use Illuminate\Http\Request;

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
        $t = Timetable::query()->paginate(30);
        return response()->json($t);
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
                'classroom_id'=>'required',
                'subject_id'=>'required',
                'day' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            $time = Timetable::create([
                'classroom_id'=>$request->classroom_id,
                'subject_id'=>$request->subject_id,
                'course_id'=>$request->course_id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
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
                'classroom_id'=>'required',
                'subject_id'=>'required',
                'day' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            $time = Timetable::find($id);
            $time = $time->update([
                'classroom_id'=>$request->classroom_id,
                'subject_id'=>$request->subject_id,
                'course_id'=>$request->course_id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
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
            $time->delete();
            return response()->json($time);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
