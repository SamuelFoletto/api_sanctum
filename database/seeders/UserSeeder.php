<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $user = new User();
        $user->name = 'Usuario01';
        $user->email = 'usuario01@api.com';
        $user->password = bcrypt('abc123');
        $user->save();

    }
}
