<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = ['ashradev@aa.com', 'din@aa.com', 'maria@gmail.com'];
        foreach ($emails as $key => $email) {
            User::create(['email' => $email, 'password' => bcrypt('123qwe'), 'name' => "User_" . $key, 'role' => User::USER]);
        }
        // Create admin
        User::create(['email' => 'admin@aa.com', 'password' => bcrypt(1), 'name' => "Admin", 'role' => User::ADMIN]);
    }
}
