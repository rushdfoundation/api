<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    public function __invoke()
    {
        $students = collect();
        $teacher = Teacher::where('user_id',Auth::id())->first();

        foreach ($teacher->classrooms as $class) {
            foreach ($class->students as $student) {
                $students->push($student);
            }
        }
        return response()->json($students);
    }
}
