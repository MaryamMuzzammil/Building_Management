<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Mezzanine_floorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mezzanine_floors')->insert([
            ['mezzanine_number' => 'M1', 'sq_ft_area' => 4000, 'tenant_id' => NULL],
            ['mezzanine_number' => 'M2', 'sq_ft_area' => 4000, 'tenant_id' => NULL],
        ]);

    }
}
