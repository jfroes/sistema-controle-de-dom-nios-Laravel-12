<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistrarAccount;

class RegistrarAccountSeeder extends Seeder
{
    public function run(): void
    {
        RegistrarAccount::insert([
            [
                'registrar_id' => 1,
                'label' => 'Conta Principal GoDaddy',
                'username' => 'admin@godaddy.com',
                'notes' => 'Conta principal da empresa'
            ],
            [
                'registrar_id' => 2,
                'label' => 'Conta Namecheap Dev',
                'username' => 'dev@namecheap.com',
                'notes' => null
            ],
            [
                'registrar_id' => 3,
                'label' => 'Conta Registro.br',
                'username' => 'contato@empresa.com',
                'notes' => 'Domínios .br'
            ],
        ]);
    }
}
