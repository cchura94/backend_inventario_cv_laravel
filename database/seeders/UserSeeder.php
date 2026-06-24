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
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@mail.com";
        $user->password = "admin54321";
        $user->save();
        
        $user2 = new User();
        $user2->name = "david";
        $user2->email = "david@mail.com";
        $user2->password = "david54321";
        $user2->save();
        
    }
}
