<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Client::insert([
            ['name' => 'Empresa Alpha'],
            ['name' => 'Startup Beta'],
            ['name' => 'Cliente Gamma'],
        ]);
    }
}
