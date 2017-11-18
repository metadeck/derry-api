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
            'email' => 'declan@metadeck.io',
            'username' => 'deckymcd',
            'role' => 'admin',
            'terms_and_policy' => true,
            'password' => bcrypt('password') // updated after seed
        ]);
    }
}
