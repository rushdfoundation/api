<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ExceptionHelper;
use App\Helpers\UserAccountHelper;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = User::with('roles.permissions')->paginate(15);
        }else{
            $data = User::with('roles.permissions')->where('school_id',$user->school_id)->paginate(15);
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
                'name'=>'required',
                'username' => 'required|string|max:255|unique:users,email|unique:users,phone|unique:users,unique_id',
                'phone'=>'required',
                'password'=>'required',
                'role_id'=>'required',
                'school_id'=>'required'
            ]);
 
            $userData = [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => false,
                'school_id' => $request->school_id,
            ];
            $username = $request->username;

            if (UserAccountHelper::isEmail($username)) {
                $userData['email'] = $username;
            } elseif (UserAccountHelper::isPhone($username)) {
                $userData['phone'] = $username;
            } else {
                $userData['unique_id'] = $username;
            }

            $user = User::create($userData);

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
