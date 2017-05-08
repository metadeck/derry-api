<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('building_category')->truncate();

        $categories = [
            'house',
            'farm/outbuilding',
            'industrial building',
            'church',
            'bridge',
            'monument',
            'other'
            ];

        foreach ($categories as $category){
            \App\Models\Category::create([
               'name' => $category
            ]);
        }

    }
}
