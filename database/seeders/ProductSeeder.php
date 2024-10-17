<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('products')->insert([
        ['EnglishName' => 'Product 1', 'EnglishDescription' => 'Description of Product 1',
         'ArabicName' => 'Product 1', 'ArabicDescription' => 'Description of Product 1',
         'TurkishName' => 'Product 1', 'TurkishDescription' => 'Description of Product 1',
        'image' => 'Product 2', 'pdf' => 'Description of Product 2'],
    ]);
}

}
