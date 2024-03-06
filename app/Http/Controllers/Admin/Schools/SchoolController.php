<?php
namespace App\Http\Controllers\Admin\Schools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::query()->get();
        return response()->json($schools);
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
                'location'=>'required'
            ]);
    
            $s = School::create([
                'name'=>$request->name,
                'location'=>$request->location
            ]);

            return response()->json($s);
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
                'name'=>'required',
                'location'=>'required'
            ]);
            $school = School::find($id);
            $school->update([
                'name'=>$request->name,
                'location'=>$request->location
            ]);
            return response()->json($school);
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
            $s = School::find($id);
            $s->delete();
            return response()->json($s);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
