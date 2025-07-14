<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class QuestionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_types')->insert([
            [
                'name' => 'Multiple Choice Question',
                'code' => 'MCQ',
                'description' => 'Select one correct option from a list of choices. Common in CISSP, CISA, CompTIA, and AWS exams.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Multiple Select Question',
                'code' => 'MSQ',
                'description' => 'Select all correct options from multiple choices. Used in CISSP, CompTIA, Azure, and AWS.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Drag & Drop – Select',
                'code' => 'DDS',
                'description' => 'Drag only correct items from a list to the answer area. Order does not matter. Common in Microsoft and CompTIA exams.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Drag & Drop – Order',
                'code' => 'DDO',
                'description' => 'Drag and arrange items in the correct order. Often used in CompTIA and AWS exams.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Matching Pairs',
                'code' => 'MP',
                'description' => 'Match items from two columns by dragging the correct pairs. Used in Azure, CompTIA, and Google Cloud exams.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hot Spot',
                'code' => 'HS',
                'description' => 'Click on the relevant area in an image or diagram. Common in GIAC and CompTIA visual-based assessments.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Command Line',
                'code' => 'CL',
                'description' => 'Provide or select command-line responses. Frequently used in GIAC, OSCP, and Red Hat practical exams.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
