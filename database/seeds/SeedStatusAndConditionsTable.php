<?php

use Illuminate\Database\Seeder;

class SeedStatusAndConditionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $conditions = [
            'good',
            'fair',
            'poor',
            'very poor',
            'ruinous'
        ];
        foreach ($conditions as $condition){
            \App\Models\Condition::create([
                'name' => $condition
            ]);
        }

    }
}
