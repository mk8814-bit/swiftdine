<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['number' => '1', 'status' => 'empty'],
            ['number' => '2', 'status' => 'empty'],
            ['number' => '3', 'status' => 'empty'],
            ['number' => '4', 'status' => 'empty'],
            ['number' => '5', 'status' => 'empty'],
        ];

        foreach ($tables as $table) {
            Meja::firstOrCreate(['number' => $table['number']], $table);
        }
    }
}
