<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $users = array(
                ['name' => 'J Smith', 'email' => 'sample1@mail.com', 'password' => bcrypt('secret')],
                ['name' => 'D Brown', 'email' => 'sample2@mail.com', 'password' => bcrypt('secret')],
                ['name' => 'Blue main', 'email' => 'sample3@email.com', 'password' => bcrypt('secret')],
                ['name' => 'jose chuck', 'email' => 'sample4@email', 'password' => bcrypt('secret')],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

    }
}
