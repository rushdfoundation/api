<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function __invoke(){
        //
    }
    public function index(){
        $user = Auth::user();
        $children = Student::where('guardian_refrence_id',$user->guardian->id)->get();
        return response()->json($children);
    }
    public function homeworks($id){
        $student = Student::find($id);
        return response()->json($student->user->homeworks);
    }
    public function assessments($id){
        $student = Student::find($id);
        return response()->json($student->user->assessments);
    }
    public function attendances($id){
        $student = Student::find($id);
        $attendances = Attendance::where('user_id',$student->user->id)->get();
        return response()->json($attendances);
    }
    public function activities($id){
        $student = Student::find($id);
        $act = Activity::where('user_id',$student->user->id)->get();
        return response()->json($act);
    }
    public function classes($id){
        $student = Student::find($id);
        return response()->json($student->classrooms);
    }
    public function courses($id){
        $student = Student::find($id);
        return response()->json($student->user->courses);
    }
}
