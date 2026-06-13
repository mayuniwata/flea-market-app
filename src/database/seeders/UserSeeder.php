<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => '山田太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(5)->create();
    }

}