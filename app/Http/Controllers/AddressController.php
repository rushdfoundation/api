<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return response()->json($user->addresses);
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
                'country'=>'required',
                'province'=>'required',
                'type'=>'required'
            ]);
            $address = AddressHelper::add($request);
            $user = User::find(Auth::id());
            $user->addresses()->attach($address);
            return response()->json($address);
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
                'country'=>'required',
                'province'=>'required',
                'type'=>'required'
            ]);
            $address = AddressHelper::edit($request,$id);
            return response()->json($address);
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
