<?php

use Illuminate\Database\Seeder;

class SeedRecordingsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recordings')->truncate();

        $conditions = \App\Models\Condition::all();
        $buildings = \App\Models\Building::all();
        $users = \App\Models\User::all();

        foreach ($buildings as $building){
            \App\Models\Recording::create([
                'building_id' => $building->id,
                'user_id' => $users->random()->id,
                'condition_id' => $conditions->random()->id,
                'created_at' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days'))
            ]);

            \App\Models\Recording::create([
                'building_id' => $building->id,
                'user_id' => $users->random()->id,
                'condition_id' => $conditions->random()->id,
                'created_at' => date('Y-m-d', strtotime( '-'.mt_rand(31,60).' days'))
            ]);

            \App\Models\Recording::create([
                'building_id' => $building->id,
                'user_id' => $users->random()->id,
                'condition_id' => $conditions->random()->id,
                'created_at' => date('Y-m-d', strtotime( '-'.mt_rand(61,90).' days'))
            ]);
        }
    }
}
