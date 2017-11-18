<?php

use Illuminate\Database\Seeder;

class BuisnessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->truncate();

        $categories = \App\Models\Category::all();
        factory(\App\Models\Business::class, 1000)->create()
            ->each(function($b) use ($categories){
                $b->categories()->sync($categories->random(2));
            });
    }
}
