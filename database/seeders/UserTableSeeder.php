<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // User::truncate();
          $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@rushd.ngo',
                'phone' => '+93793778030',
                'password' => Hash::make('123'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@rushd.ngo',
                'phone' => '+93793778040',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Student',
                'email' => 'student@rushd.ngo',
                'phone' => '+93793778041',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Parent',
                'email' => 'parent@rushd.ngo',
                'phone' => '+93793778042',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Trainer',
                'email' => 'trainer@rushd.ngo',
                'phone' => '+93793778043',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Trainee',
                'email' => 'trainee@rushd.ngo',
                'phone' => '+93793778044',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
            [
                'name' => 'Modeer',
                'email' => 'modeer@rushd.ngo',
                'phone' => '+93793778045',
                'password' => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),
                'is_active' => true,
                'is_logedin' => true,
                'school_id' => 1
            ],
        ];
        User::insert($users);

        $adminUser = User::where('name','Admin')->first();
        $adminRole = Role::where('name','admin')->first();
        $adminUser->roles()->attach($adminRole);
        $adminUser->markEmailAsVerified();

        $teacherUser = User::where('name','Teacher')->first();
        $teacherRole = Role::where('name','teacher')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();

        $teacherUser = User::where('name','Student')->first();
        $teacherRole = Role::where('name','student')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();

        $teacherUser = User::where('name','Parent')->first();
        $teacherRole = Role::where('name','guardian')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();

        $teacherUser = User::where('name','Trainer')->first();
        $teacherRole = Role::where('name','trainer')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();

        $teacherUser = User::where('name','Trainee')->first();
        $teacherRole = Role::where('name','trainee')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();

        $teacherUser = User::where('name','Modeer')->first();
        $teacherRole = Role::where('name','modeer')->first();
        $teacherUser->roles()->attach($teacherRole);
        $teacherUser->markEmailAsVerified();
    }
}
