<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registrar;

class RegistrarSeeder extends Seeder
{
    public function run(): void
    {
        Registrar::insert([
            [
                'name' => 'GoDaddy',
                'website' => 'https://godaddy.com'
            ],
            [
                'name' => 'Namecheap',
                'website' => 'https://namecheap.com'
            ],
            [
                'name' => 'Registro.br',
                'website' => 'https://registro.br'
            ],
        ]);
    }
}
