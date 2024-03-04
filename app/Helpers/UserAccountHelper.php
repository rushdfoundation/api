<?php
namespace App\Helpers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAccountHelper{

    static function credentials($request)
    {
        $username = $request->input('username');
        $loginType = 'unique_id';
    
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $loginType = 'email';
        } elseif (preg_match('/^[0-9]{10}+$/', $username)) {
            $loginType = 'phone';
        }
        return array_merge([$loginType => $username], $request->only('password'));
    }
    static function find($request){
        $user = User::where('email', $request->username)
        ->orWhere('phone',  $request->username)
        ->orWhere('unique_id', $request->username)
        ->first();
        return $user;
    }
    static function isEmail($input){
        return filter_var(trim($input), FILTER_VALIDATE_EMAIL)?true:false;
    }
    static function isPhone($input){
        return preg_match('/^(\+\d{11}|00\d{11})$/', trim($input))?true:false;
    }
}