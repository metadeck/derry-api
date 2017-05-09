<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        //create an admin user
        User::create([
            'first_name' => 'Declan',
            'last_name' => 'McDonough',
            'email' => 'declan@uahs.com',
            'username' => 'deckymcd',
            'role' => 'owner',
            'terms_and_policy' => true,
            'is_admin' => true,
            'points' => 0,
            'password' => bcrypt('password')
        ]);

        factory(\App\Models\User::class, 100)->create(['role' => 'appuser']);
    }
}
