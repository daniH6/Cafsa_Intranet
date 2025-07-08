<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder {

    public function run() {

        if(env('APP_ENV') != 'production')
        {
            $password = Hash::make('secret');

            for ($i = 1; $i <= 30; $i++)
            {
                $users[] = [
                    'name' => 'User'. $i,
                    'email' => 'user'. $i .'@myapp.com',
                    'password' => $password,
                ];
            }

            User::insert($users);
        }
    }
}