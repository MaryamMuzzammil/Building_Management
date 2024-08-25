<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flats')->insert([
            // Data for flats on the first floor
            ['flat_number' => 1, 'floor_number' => 1, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 2, 'floor_number' => 1, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 3, 'floor_number' => 1, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 4, 'floor_number' => 1, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 5, 'floor_number' => 1, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 6, 'floor_number' => 1, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 7, 'floor_number' => 1, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 8, 'floor_number' => 1, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 9, 'floor_number' => 1, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 10, 'floor_number' => 1, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 11, 'floor_number' => 1, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],

            // Data for flats on the second floor
            ['flat_number' => 12, 'floor_number' => 2, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 13, 'floor_number' => 2, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 14, 'floor_number' => 2, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 15, 'floor_number' => 2, 'total_rooms' => 5, 'sq_ft_area' => 1200, 'tenant_id' => NULL],
            ['flat_number' => 16, 'floor_number' => 2, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 17, 'floor_number' => 2, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 18, 'floor_number' => 2, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 19, 'floor_number' => 2, 'total_rooms' => 5, 'sq_ft_area' => 1200, 'tenant_id' => NULL],
            ['flat_number' => 20, 'floor_number' => 2, 'total_rooms' => 5, 'sq_ft_area' => 1200, 'tenant_id' => NULL],
            ['flat_number' => 21, 'floor_number' => 2, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 22, 'floor_number' => 2, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],

            // Data for flats on the third floor
            ['flat_number' => 23, 'floor_number' => 3, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 24, 'floor_number' => 3, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 25, 'floor_number' => 3, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 26, 'floor_number' => 3, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 27, 'floor_number' => 3, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 28, 'floor_number' => 3, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 29, 'floor_number' => 3, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 30, 'floor_number' => 3, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 31, 'floor_number' => 3, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 32, 'floor_number' => 3, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 33, 'floor_number' => 3, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],

            // Data for flats on the fourth floor
            ['flat_number' => 34, 'floor_number' => 4, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 35, 'floor_number' => 4, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 36, 'floor_number' => 4, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 37, 'floor_number' => 4, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 38, 'floor_number' => 4, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 39, 'floor_number' => 4, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 40, 'floor_number' => 4, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 41, 'floor_number' => 4, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 42, 'floor_number' => 4, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 43, 'floor_number' => 4, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 44, 'floor_number' => 4, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],

            // Data for flats on the fifth floor
            ['flat_number' => 45, 'floor_number' => 5, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 46, 'floor_number' => 5, 'total_rooms' => 1, 'sq_ft_area' => 500, 'tenant_id' => NULL],
            ['flat_number' => 47, 'floor_number' => 5, 'total_rooms' => 1, 'sq_ft_area' => 500, 'tenant_id' => NULL],
            ['flat_number' => 48, 'floor_number' => 5, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 49, 'floor_number' => 5, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 50, 'floor_number' => 5, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 51, 'floor_number' => 5, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 52, 'floor_number' => 5, 'total_rooms' => 4, 'sq_ft_area' => 950, 'tenant_id' => NULL],
            ['flat_number' => 53, 'floor_number' => 5, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 54, 'floor_number' => 5, 'total_rooms' => 3, 'sq_ft_area' => 700, 'tenant_id' => NULL],
            ['flat_number' => 55, 'floor_number' => 5, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 56, 'floor_number' => 5, 'total_rooms' => 2, 'sq_ft_area' => 600, 'tenant_id' => NULL],
            ['flat_number' => 57, 'floor_number' => 5, 'total_rooms' => 1, 'sq_ft_area' => 500, 'tenant_id' => NULL],
        ]);
    }
}
