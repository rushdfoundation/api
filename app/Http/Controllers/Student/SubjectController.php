<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function __invoke()
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::where('user_id', Auth::id())->first();

        //get the current classroom
        $classroom = $student->classrooms()->latest('created_at')->first();
        
        $subjects = DB::table('subjects')
        ->join('classrooms', 'classrooms.id', '=', 'subjects.classroom_id')
        ->join('student_classroom', function ($join) use ($student, $classroom) {
            $join->on('student_classroom.classroom_id', '=', 'classrooms.id')
                ->where('student_classroom.student_id', $student->id)
                ->where('student_classroom.classroom_id', $classroom->id);
        })
        ->select('subjects.*')
        ->get();

        return response()->json($subjects);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with('lectures')->find($id);
        return response()->json($subject->lectures);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
