<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{ 
    function __construct()
    {
        $this->middleware(['permission:view_teachers'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_teacher'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_teacher'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_teacher'], ['only' => ['destroy']]);
    }
    /**
    * Display a listing of the resource.
    */
   public function index()
   {   
       $user = Auth::user();
       if($user->hasRole('admin')){
           $data = Teacher::with('user')->orderBy('created_at','DESC')->paginate(30);
       }else{
           $data = Teacher::with('user')->where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
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
               'first_name' => 'required|string|max:255',
               'last_name' => 'required|string|max:255',
               'gender' =>'required|string|max:255',
               'dob' => 'required',
               'job' => 'required|string|max:255',
               'tazkira_number' =>  'required|string|max:255',
               'marital_status' =>  'required|string|max:255',
               'user_id' => 'required',
               'school_id'=>'required'
           ]);

           $teacher = Teacher::create([
               "first_name" => $request->first_name,
               "last_name" => $request->last_name,
               "father_name" => $request->father_name,
               'gender' => $request->gender,
               'dob' => $request->dob,
               'doj' => Carbon::now(),
               'job' => $request->job,
               'tazkira_number' => $request->tazkira_number,
               'marital_status' => $request->marital_status,
               "user_id" => $request->user_id,
               "school_id"=>$request->school_id
           ]);
           return response()->json($teacher);
       }catch(Exception $e){
            return ExceptionHelper::handle($e);
       }
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
        $teacher = Teacher::with('user','user.addresses','user.courses','user.activities','user.attendances','user.educations','user.experiences')
        ->find($id);
        return response()->json($teacher);
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
               'first_name' => 'required|string|max:255',
               'last_name' => 'required|string|max:255',
               'gender' =>'required|string|max:255',
               'dob' => 'required',
               'job' => 'required|string|max:255',
               'tazkira_number' =>  'required|string|max:255',
               'marital_status' =>  'required|string|max:255',
           ]);

           $teacher = Teacher::find($id);

           $teacher->first_name = $request->first_name;
           $teacher->last_name = $request->last_name;
           $teacher->father_name = $request->father_name;
           $teacher->gender = $request->gender;
           $teacher->dob = $request->dob;
           $teacher->job = $request->job;
           $teacher->tazkira_number = $request->tazkira_number;
           $teacher->marital_status = $request->marital_status;
           $teacher->update();
           return response()->json($teacher);
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
        $teacher = Teacher::find($id);
        $teacher->delete();
        return response()->json($teacher);
    }catch(Exception $e){
        return ExceptionHelper::handle($e);
    }
   }
}
