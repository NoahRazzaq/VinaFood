<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users= [
            [
            'name'=> 'noah',
            'email'=> 'noah@gmail.com',
            'password'=> bcrypt('Manchesterutd')
            ],
            [
                'name'=> 'thomas',
                'email'=> 'thomas@gmail.com',
                'password'=> bcrypt('12345678')

            ]
        ];
        User::insert($users);
    }
}
