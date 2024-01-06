<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1;$i <= 100000;$i++){
            User::create([
                'name' => "User $i dsd",
                'email' => "user".$i."dsdsd@gmail.com",
                'password' => 'admin@123',
            ]);
        }
    }
}
