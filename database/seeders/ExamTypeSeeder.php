<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name'=>'آزمایشی کانکور'],
            ['name'=>'ارتقای ظرفیت'],
            ['name'=>'زبان'],
            ['name'=>'کمپیوتر'],
            ['name'=>'دینی'],
            ['name'=>'تخنیکی'],
            ['name'=>'مضامین مکتب'],
        ];
        ExamType::insert($types);
    }
}
