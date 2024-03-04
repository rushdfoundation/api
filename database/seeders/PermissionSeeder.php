<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Permission::truncate();
         $permissions = [
            ['name' => 'view_users'],
            ['name' => 'create_user'],
            ['name' => 'edit_user'],
            ['name' => 'delete_user'],

            ['name' => 'view_classes'],
            ['name' => 'create_class'],
            ['name' => 'edit_class'],
            ['name' => 'delete_class'],

            ['name' => 'view_lectures'],
            ['name' => 'create_lecture'],
            ['name' => 'edit_lecture'],
            ['name' => 'delete_lecture'],

            ['name' => 'view_subjects'],
            ['name' => 'create_subject'],
            ['name' => 'edit_subject'],
            ['name' => 'delete_subject'],

            ['name' => 'view_courses'],
            ['name' => 'create_course'],
            ['name' => 'edit_course'],
            ['name' => 'delete_course'],

            ['name' => 'view_exams'],
            ['name' => 'create_exam'],
            ['name' => 'edit_exam'],
            ['name' => 'delete_exam'],

            ['name' => 'view_guardians'],
            ['name' => 'create_guardian'],
            ['name' => 'edit_guardian'],
            ['name' => 'delete_guardian'],

            ['name' => 'view_libraries'],
            ['name' => 'create_library'],
            ['name' => 'edit_library'],
            ['name' => 'delete_library'],
            
            ['name' => 'upload_file'],

            ['name' => 'view_lookups'],
            ['name' => 'create_lookup'],
            ['name' => 'edit_lookup'],
            ['name' => 'delete_lookup'],

            ['name' => 'view_questions'],
            ['name' => 'create_question'],
            ['name' => 'edit_question'],
            ['name' => 'delete_question'],

            ['name' => 'view_students'],
            ['name' => 'create_student'],
            ['name' => 'edit_student'],
            ['name' => 'delete_student'],

            ['name' => 'view_teachers'],
            ['name' => 'create_teacher'],
            ['name' => 'edit_teacher'],
            ['name' => 'delete_teacher'],

            ['name' => 'view_timetables'],
            ['name' => 'create_timetable'],
            ['name' => 'edit_timetable'],
            ['name' => 'delete_timetable'],

            ['name' => 'view_trainees'],
            ['name' => 'create_trainee'],
            ['name' => 'edit_trainee'],
            ['name' => 'delete_trainee'],

            ['name' => 'view_videos'],
            ['name' => 'create_video'],
            ['name' => 'edit_video'],
            ['name' => 'delete_video'],

            ['name' => 'view_users'],
            ['name' => 'create_user'],
            ['name' => 'edit_user'],
            ['name' => 'delete_user'],
        ];
        Permission::insert($permissions);
    }
}
