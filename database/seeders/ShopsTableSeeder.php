<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            ['shop_number' => 1, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 2, 'sq_ft_area' => 0, 'tenant_id' => NULL],
            ['shop_number' => 3, 'sq_ft_area' => 0, 'tenant_id' => NULL],
            ['shop_number' => 4, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 5, 'sq_ft_area' => 300, 'tenant_id' => NULL],
            ['shop_number' => 6, 'sq_ft_area' => 300, 'tenant_id' => NULL],
            ['shop_number' => 7, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 8, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 9, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 10, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 11, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 12, 'sq_ft_area' => 200, 'tenant_id' => NULL],
            ['shop_number' => 13, 'sq_ft_area' => 200, 'tenant_id' => NULL],
        ]);
    }
}
