<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en' => 'First class', 'ar' => ' الصف1'],
            ['en' => 'Second class', 'ar' => ' الصف2'],
            ['en' => 'Third class', 'ar' => 'الصف3 '],
        ];

        foreach ($classrooms as $classroom) {


            Classroom::create([
                'classname' => $classroom,

                'Grade_id' => Grade::all()->unique()->random()->id,
            ]);
        }
    }
}
