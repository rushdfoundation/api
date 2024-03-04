<?php

use App\Http\Controllers\Admin\Courses\CourseController as AdminCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guardian\ChildrenController;
use App\Http\Controllers\Guardian\GuardianController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AddressController ;
use App\Http\Controllers\Admin\Classes\ClassesController as AdminClassesController;
use App\Http\Controllers\Admin\Classes\LecturesController;
use App\Http\Controllers\Admin\Classes\SubjectsController;
use App\Http\Controllers\Admin\Courses\LecturesController as AdminCoursesLectureController;
use App\Http\Controllers\Admin\Exams\ExamController as AdminExamController;
use App\Http\Controllers\Admin\Guardians\GuardiansController;
use App\Http\Controllers\Admin\Library\LibraryController as AdminLibraryController;
use App\Http\Controllers\Admin\Library\UploadBookController;
use App\Http\Controllers\Admin\QuestionsBank\AnswerController;
use App\Http\Controllers\Admin\QuestionsBank\QuestionController;
use App\Http\Controllers\Admin\Stutents\StudentsController;
use App\Http\Controllers\Admin\Teachers\TeachersController;
use App\Http\Controllers\Admin\Timetables\TimetablesController;
use App\Http\Controllers\Admin\Users\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\Videos\VideoController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\SubjectController;
use App\Http\Controllers\Teacher\ActivityController as TeacherActivityController;
use App\Http\Controllers\Teacher\AssessmentController as TeacherAssessmentController;
use App\Http\Controllers\Teacher\ClassesController as TeacherClassesController;
use App\Http\Controllers\Teacher\ClassLectureController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\CourseLectureController;
use App\Http\Controllers\Teacher\EducationController;
use App\Http\Controllers\Teacher\ExperienceController;
use App\Http\Controllers\Teacher\HomeworkController as TeacherHomeworkController;
use App\Http\Controllers\Teacher\StudentsController as TeacherStudentsController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TimeTableController as TeacherTimeTableController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\Trainee\TraineeController;
use App\Http\Controllers\UploadFileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('create-user-by-id', 'createUserById'); //temporary api
    Route::post('logout', 'logout');
    Route::get('me', 'me');
    Route::post('avatar','avatar');
});

Route::get('library',LibraryController::class);
Route::get('notice-board',NoticeBoardController::class);

Route::group(['middleware'=>'auth:api'],function(){
    Route::post('file/upload',[UploadFileController::class,'upload']);
    Route::post('file/remove',[UploadFileController::class,'remove']);
    Route::resource('notifications',NotificationController::class);
    Route::resource('comments',CommentController::class);
    Route::get('courses/enrolled',[CourseController::class,'enrolled']);
    Route::resource('courses',CourseController::class);
    Route::resource('addresses',AddressController::class);
    Route::resource('homeworks',HomeworkController::class);
    Route::resource('assessments',AssessmentController::class);
    Route::resource('activities',ActivityController::class);
    Route::resource('attendances',AttendanceController::class);
    Route::resource('timetable',TimeTableController::class);
    Route::resource('exams',ExamController::class);

    Route::group(['prefix' => 'teacher'],function(){
        Route::resource('profile',TeacherController::class);
        Route::resource('educations',EducationController::class);
        Route::resource('experiences',ExperienceController::class);
        Route::resource('timetable',TeacherTimeTableController::class);
        Route::resource('attendance',AttendanceController::class);
        Route::resource('homeworks',TeacherHomeworkController::class);
        Route::resource('assessments',TeacherAssessmentController::class);
        Route::resource('courses',TeacherCourseController::class);
        Route::resource('class/lectures',ClassLectureController::class);
        Route::resource('course/lectures',CourseLectureController::class);
        Route::resource('classes',TeacherClassesController::class);
        Route::get('students',TeacherStudentsController::class);
   })->middleware('role:teacher');

    Route::group(['prefix' => 'guardian'],function(){
        Route::resource('profile',GuardianController::class);
        Route::resource('children',ChildrenController::class);
        Route::get('child/homeworks/{id}',[ChildrenController::class,'homeworks']);
        Route::get('child/attendances/{id}',[ChildrenController::class,'attendances']);
        Route::get('child/assessments/{id}',[ChildrenController::class,'assessments']);
        Route::get('child/activities/{id}',[ChildrenController::class,'activities']);
        Route::get('child/classes/{id}',[ChildrenController::class,'classes']);
        Route::get('child/courses/{id}',[ChildrenController::class,'courses']);
    })->middleware('role:guardian');

    Route::group(['prefix' => 'student'],function(){
        Route::resource('profile',StudentController::class);
        Route::resource('subjects',SubjectController::class);
    })->middleware('role:student');
    
    Route::group(['prefix'=>'trainee'],function(){
        Route::resource('profile',TraineeController::class);
    })->middleware('role:trainee');

    Route::group(['prefix' => 'admin'],function(){
        Route::resource('users',AdminUsersController::class);
        Route::resource('classes',AdminClassesController::class);
        Route::resource('subjects/lectures',AdminCoursesLectureController::class);
        Route::resource('subjects',SubjectsController::class);
        Route::resource('courses/lectures',LecturesController::class);
        Route::resource('courses',AdminCourseController::class);
        Route::resource('guardians',GuardiansController::class);
        Route::post('library/books/upload',[UploadBookController::class,'upload']);
        Route::post('library/books/remove',[UploadBookController::class,'remove']);
        Route::resource('library',AdminLibraryController::class);
        Route::resource('students',StudentsController::class);
        Route::resource('teachers',TeachersController::class);
        Route::resource('timetables',TimetablesController::class);
        Route::resource('exams',AdminExamController::class);
        Route::post('exams/question/add',[AdminExamController::class,'addQuestion']);
        Route::delete('exams/question/remove',[AdminExamController::class,'removeQuestion']);
        Route::resource('questions',QuestionController::class);
        Route::resource('answers',AnswerController::class);
    })->middleware('role:admin');
});

Route::resource('videos', VideoController::class);

Route::middleware(['auth:api'])->resource('users', TestController::class);

Route::get('unauthorized',function(){
    return response()->json([
        'message'=>'Unauthorized',
    ],403);
})->name('unauthorized');
