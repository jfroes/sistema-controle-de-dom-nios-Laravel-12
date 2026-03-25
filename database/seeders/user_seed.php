<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class user_seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'John Doe',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin'),
            'status' => 'ativo',
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
