<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Role::truncate();
        $roles = [
            ['name' => 'admin'],
            ['name' => 'support'],
            ['name' => 'modeer'],
            ['name' => 'teacher'],
            ['name' => 'trainer'],
            ['name' => 'student'],
            ['name' => 'trainee'],
            ['name' => 'guardian'],
            ['name' => 'guest'],
        ];
        Role::insert($roles);

        $adminRole = Role::where('name','admin')->first();
        $adminPermissions = Permission::all();
        $adminRole->permissions()->attach($adminPermissions);

        $teacherRole = Role::where('name','teacher')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);

        $teacherRole = Role::where('name','teacher')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);

        $teacherRole = Role::where('name','student')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);

        $teacherRole = Role::where('name','guardian')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);

        $teacherRole = Role::where('name','trainer')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);

        $teacherRole = Role::where('name','trainee')->first();
        $teacherPermission = Permission::where('name','view_users')->first();
        $teacherRole->permissions()->attach($teacherPermission);
    }
}
