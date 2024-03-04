<?php

namespace App\Http\Controllers\Admin\Stutents;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

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
        $data = Student::query()->paginate(30);
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
                'tazkira_number' =>  'required|string|max:255',
                'marital_status' =>  'required|string|max:255',
                'guardian_refrence_id'=>'required',
            ]);

            $teacher = Student::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "father_name" => $request->father_name,
                "grand_father_name" => $request->grand_father_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'doj' => Carbon::now(),
                'tazikra_number' => $request->tazkira_number,
                'marital_status' => $request->marital_status,
                "user_id" => $request->user_id,
                "guardian_refrence_id" => $request->guardian_refrence_id,
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
        $user = User::with('trainee','addresses','courses','activities','attendances')
        ->where('trainee_id',$id)->first();
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
            $student->tazikra_number = $request->tazkira_number;
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
