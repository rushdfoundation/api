<?php

namespace App\Http\Controllers\Trainee;

use App\Helpers\AddressHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Trainee;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
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
                'gender' =>'required|string|max:255',
                'dob' => 'required',
            ]);

            $teacher = Trainee::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "father_name" => $request->father_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'doj' => Carbon::now(),
                'tazkira_number' => $request->tazkira_number,
                'marital_status' => $request->marital_status,
                "user_id" => Auth::id(),
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
            $student = Trainee::find($id); 
            $student->update([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "father_name" => $request->father_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'tazkira_number' => $request->tazkira_number,
                'marital_status' => $request->marital_status,
            ]);
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
