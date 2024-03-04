<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __invoke()
    {
        
    }
    public function index(){
        $courses = Course::query()->paginate(30);
        return response()->json($courses);
    }
  
    public function show($id){
        $course = Course::with('lectures','trainer')->find($id);
        return response()->json($course);
    }
    
    public function enrolled(){
        $user = User::find(Auth::id());
        $courses = $user->courses()->paginate(30);
        return response()->json($courses);
    }
   
}
