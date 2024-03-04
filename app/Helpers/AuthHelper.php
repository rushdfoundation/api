<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthHelper{
    static function signIn(){
        $user = User::find(Auth::id());
        $user->is_logedin=true;
        $user->update();
    }
    static function signOut(){
        $user = User::find(Auth::id());
        $user->is_logedin=false;
        $user->update();
    }
    static function active(){
        $user = User::find(Auth::id());
        $user->is_active=true;
        $user->update();
    }
    static function deactive(){
        $user = User::find(Auth::id());
        $user->is_active=false;
        $user->update();
    }
}