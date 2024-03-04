<?php

namespace App\Http\Controllers\Student;

use App\Helpers\AddressHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('student','addresses')->find(Auth::id());
        return response()->json($user);
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
                "user_id" => Auth::id(),
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
        //
    }
}
