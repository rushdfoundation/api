<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class TestController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_users'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_user'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_user'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_user'], ['only' => ['destroy']]);
    }
    public function index(){

        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request){

        return response()->json("you authorized ");
        $user = new User();
        $user->name ='Test user';
        $user->email = 'test@rushd.ngo';
        $user->phone = '+93793778050';
        $user->password = Hash::make('123');
        $user->email_verified_at = Carbon::now();
        $user->phone_verified_at = Carbon::now();
        $user->is_active = true;
        $user->is_logedin = true;
        $user->school_id = 1;
        $user = User::where('name','Teacher')->first();
        $role = Role::where('name','teacher')->first();
        $user->roles()->attach($role);
        return response()->json($user);
    }
    public function update(Request $request, $id){
        $this->authorize('edit user');

        $user = User::find($id);
        $user = new User();
        $user->name ='Test user';
        $user->email = 'test@rushd.ngo';
        $user->phone = '+93793778050';
        $user->password = Hash::make('123');
        $user->email_verified_at = Carbon::now();
        $user->phone_verified_at = Carbon::now();
        $user->is_active = true;
        $user->is_logedin = true;
        $user->school_id = 1;
        $user->update();
        return response()->json($user);
    }

    public function delete($id){
        $this->authorize('delete user');

        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }






    public function __invoke()
    {   
        $channelId = 'UCi6gbr9I8F7MryF760tO_hw';
        $keywords = "*";
        $part = 'snippet';
        $country = 'AF';
        $apiKey = Config::get('services.youtube.api_key');
        $endPoint = Config::get('services.youtube.search_endpoint');
        $maxResults = 12;
        $type = 'video,playlist,channel';
        $url = "$endPoint?part=$part&maxResults=$maxResults&regionCode=$country&type=$type&key=$apiKey&q=$keywords";
        $res = Http::get($url);
        $results = json_decode($res);
        return response()->json($results);
    }

   
}
