<?php

namespace App\Http\Controllers\Admin\Stutents;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_students'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_student'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_student'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_student'], ['only' => ['destroy']]);
    }
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = Student::with('user')->orderBy('created_at','DESC')->paginate(30);
        }else{
            $data = Student::with('user')->where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
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
                'father_name' => 'required|string|max:255',
                'grand_father_name' => 'required|string|max:255',
                'gender' =>'required|string|max:255',
                'dob' => 'required',
                'tazkira_number' =>  'required|string|unique:students|max:255',
                'guardian_refrence_id'=> 'required|exists:guardians,child_refrence_id',
                'school_id'=>'required',
                'user_id'=>'required'
            ]);

            $teacher = Student::create([
                "roll_number"=>'R2024-'. rand(5000,10000),
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "father_name" => $request->father_name,
                "grand_father_name" => $request->grand_father_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'doj' => Carbon::now(),
                'tazkira_number' => $request->tazkira_number,
                'marital_status' => $request->marital_status,
                'user_id' => $request->user_id,
                'guardian_refrence_id' => $request->guardian_refrence_id,
                'school_id'=>$request->school_id,
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
        $user = Student::with('user','user.addresses','user.courses','user.activities','user.attendances')
        ->find($id);
        return response()->json($user);
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
            $student = Student::find($id); 
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->grand_father_name = $request->grand_father_name;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
            $student->tazkira_number = $request->tazkira_number;
            $student->marital_status = $request->marital_status;
            $student->update();
            return response()->json($student);
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
            $st = Student::find($id);
            $st->delete();
            return response()->json($st);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
