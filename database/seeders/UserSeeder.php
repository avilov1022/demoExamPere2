<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name'=> 'admin',
                    'tel' => '891545454',
                    'email'=> 'admin@mail.com',
                    'password'=> Hash::make('administrator'),
                ],
            ]
        );
    }
}
