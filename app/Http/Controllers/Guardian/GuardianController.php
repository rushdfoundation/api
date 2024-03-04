<?php

namespace App\Http\Controllers\Guardian;

use App\Helpers\AddressHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('guardian','address')->find(Auth::id());
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
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
                'job'=>'required',
                'dob'=>'required',
            ]);
            $user = User::find(Auth::id());
            $guardian = Guardian::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender'=>$request->gender,
                'job'=>$request->job,
                'dob'=>$request->dob,
                'tazikra_number'=>$request->tazkira_number,
                'marital_status'=>$request->marital_status,
                'user_id' => $user->id,
                'child_refrence_id' => rand(5000,10000),
            ]);

            return response()->json($guardian);
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
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
                'job'=>'required',
                'dob'=>'required',
            ]);
            $guardian =  Guardian::find($id);
            $guardian->first_name=$request->first_name;
            $guardian->last_name=$request->last_name;
            $guardian->gender=$request->gender;
            $guardian->job=$request->job;
            $guardian->dob=$request->dob;
            $guardian->tazikra_number=$request->tazkira_number;
            $guardian->marital_status=$request->marital_status;
            $guardian->update();
            return response()->json($guardian);
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
