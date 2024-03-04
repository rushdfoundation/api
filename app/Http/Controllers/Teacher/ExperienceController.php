<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'position'=>'required',
                'organization'=>'required',
                'organization_location'=>'required',
                'from'=> 'required',
                'to' => 'required',
                'tasks'=> 'required'
            ]);

            $education = Experience::create([
                'position'=>$request->position,
                'organization'=>$request->organization,
                'organization_location'=>$request->organization_location,
                'from' => $request->from,
                'to' => $request->to,
                'tasks' => $request->tasks,
                'user_id' => Auth::id()
            ]);
            return response()->json($education);
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
                'position'=>'required',
                'orgnization'=>'required',
                'orgnization_location'=>'required',
                'from'=> 'required',
                'to' => 'required',
                'tasks'=> 'required'
            ]);
    
            $education = Experience::find($id);
            $education->update([
                'position'=>$request->position,
                'orgnization'=>$request->orgnization,
                'orgnization_location'=>$request->orgnization_location,
                'from' => $request->from,
                'to' => $request->to,
                'tasks' => $request->tasks,
            ]);
            return response()->json($education);
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
