<?php

namespace App\Http\Controllers\Admin\Classes;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClassesController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_classes'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_class'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_class'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_class'], ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = Classroom::withCount('students')
            ->orderBy('created_at','DESC')
            ->paginate(30);
        }else{
            $data = Classroom::withCount('students')
            ->where('school_id',$user->school_id)
            ->orderBy('created_at','DESC')
            ->paginate(30);
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
                'name'=>'required',
                'school_id'=>'required'
            ]);
    
            $course=Classroom::create([
                'name'=>$request->name,
                'room'=>$request->room,
                'school_id'=>$request->school_id,
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
        $classes = Classroom::find($id);
        return response()->json($classes);
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
            ]);
            $class = Classroom::find($id);
            $class->name = $request->name;
            $class->room = $request->room;
            $class->update();

            return response()->json($class);
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
            $class = Classroom::find($id);
            $class->delete();
            return response()->json($class);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
 
    }
}
