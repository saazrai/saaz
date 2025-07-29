<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloomLevels = [
            [
                'id' => 1,
                'name' => 'Remember',
                'code' => 'L1',
                'description' => 'Recall facts and basic concepts',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Understand',
                'code' => 'L2',
                'description' => 'Explain ideas or concepts',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Apply',
                'code' => 'L3',
                'description' => 'Use information in new situations',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Analyze',
                'code' => 'L4',
                'description' => 'Draw connections among ideas',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Evaluate',
                'code' => 'L5',
                'description' => 'Justify a stand or decision',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => 'Create',
                'code' => 'L6',
                'description' => 'Produce new or original work',
                'is_active' => true,
            ],
        ];

        foreach ($bloomLevels as $level) {
            DB::table('blooms')->updateOrInsert(
                ['id' => $level['id']],
                array_merge($level, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
