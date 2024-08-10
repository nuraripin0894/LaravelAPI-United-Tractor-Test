<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_category_id' => 1,
                'name' => 'Gergaji',
                'price' => 100000,
                'image' => 'gergaji.jpg',
            ],
            [
                'product_category_id' => 2,
                'name' => 'Baju',
                'price' => 80000,
                'image' => 'baju.jpg',
            ],
            [
                'product_category_id' => 3,
                'name' => 'Kursi',
                'price' => 250000,
                'image' => 'kursi.jpg',
            ],
        ]);
    }
}
