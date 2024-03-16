<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_courses'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_course'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_course'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_course'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $courses = Course::with('trainer')
            ->withCount('users')
            ->orderBy('created_at','DESC')
            ->paginate(30);
        }else{
            $courses = Course::with('trainer')
            ->withCount('users')
            ->where('school_id',$user->school_id)
            ->orderBy('created_at','DESC')
            ->paginate(30);
        }
        return response()->json($courses);
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
                'school_id'=>'required',
                'type_id'=>'required',
                'trainer_id'=>'required'
            ]);
    
            $course=Course::create([
                'name'=>$request->name,
                'type_id'=>$request->type_id,
                'trainer_id'=>$request->trainer_id,
                'school_id'=>$request->school_id,
                'description'=>$request->description
            ]);
            return response()->json($course);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('lectures','trainer','courseType')->find($id);
        return response()->json($course);
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
                'type_id'=>'required',
                'trainer_id'=>'required'
            ]);
            $course = Course::find($id);
            $course->name = $request->name;
            $course->description = $request->description;
            $course->type_id = $request->type_id;
            $course->trainer_id = $request->trainer_id;
            $course->update();
            return response()->json($course);
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
            $course = Course::find($id);
            $course->delete();
            return response()->json($course);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }
}
