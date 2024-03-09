<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_users'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_user'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_user'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_user'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles.permissions')->get();
        return response()->json($users);
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
                'email'=>'required',
                'phone'=>'required',
                'password'=>'required',
                'role_id'=>'required',
                'school_id'=>'required',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => false,
                'school_id' => $request->school_id,
            ]);
            $role = Role::find($request->role_id);
            $user->roles()->attach($role);
            return response()->json($user);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles.permissions')->find($id);
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
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'password'=>'required',
                'role_id'=>'required',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();
            
            $user->roles()->detach();

            $role = Role::find($request->role_id);
            $user->roles()->attach($role);
            return response()->json($user);
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
            $st = User::find($id);
            $st->delete();
            return response()->json($st);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
