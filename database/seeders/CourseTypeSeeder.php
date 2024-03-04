<?php

namespace Database\Seeders;

use App\Models\CourseType;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $types = [
            ['name' => 'آماده گی کانکور'],
            ['name'=>'ارتقای ظرفیت'],
            ['name'=>'زبان'],
            ['name'=>'کمپیوتر'],
            ['name'=>'دینی'],
            ['name'=>'تخنیکی'],
            ['name'=>'مضامین مکتب'],
        ];
        CourseType::insert($types);
    }
}
