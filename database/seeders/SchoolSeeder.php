<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Online School',
                'location' => 'Online'
            ],
            [
                'name' => 'Khairol Anam Primary School',
                'location' => 'Located in Logar province, district 12'
            ],
        ];
        School::insert($schools);
    }
}
