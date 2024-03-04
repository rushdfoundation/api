<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Helpers\ExceptionHelper;
use App\Helpers\UserAccountHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = UserAccountHelper::find($request);

            if (!$user) {
                return response()->json([
                    'message' => 'This user does exist!',
                ], 404);
            }

            $credentials = UserAccountHelper::credentials($request);
            $token = Auth::attempt($credentials);
            
            if (!$token) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }
            AuthHelper::signIn();
            return response()->json([
                'user' => Auth::user(),
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'role' => 'required|string',
                'username' => "required|string|max:255|unique:users,email|unique:users,phone|unique:users,unique_id",
            ]);

            $userData = [
                'name' => $request->name,
                'password' => Hash::make($request->password),
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

            $role = Role::where('name',$request->role)->first();
            $user->roles()->attach($role);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return ExceptionHelper::handle($e);

        }
    }

    public function logout()
    {
        Auth::logout();
        AuthHelper::signOut();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function me(){
        $user = Auth::user();
        return response()->json([
            "user" => $user,
        ]);
    }

    public function avatar(Request $request){
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = time() . '.' . $file->getClientOriginalName();
            $path = "public/files/" . $user->id. '/'. $file_name;
            
            if ($user->avatar) {
                Storage::disk('local')->delete($user->avatar);
            }

            Storage::disk('local')->put($path, file_get_contents($file));
            return response()->json([
                'path' => $path,
                'type' => "avatar"
            ]);
        }
    }

}