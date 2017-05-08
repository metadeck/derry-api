<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->truncate();

        $categories = \App\Models\Category::all();
        factory(\App\Models\Building::class, 1000)->create()
            ->each(function($b) use ($categories){
                $b->categories()->sync($categories->random(2));
            });
    }
}
