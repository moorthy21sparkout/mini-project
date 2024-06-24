<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Jegadesh Admin',
            'email' => 'jegadesh54321@gmail.com',
            'password' => bcrypt('123456789'), // Encrypt password
            'usertype' => 'admin', // Assuming 'usertype' field exists in your users table
        ]);
    }
}
