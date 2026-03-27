<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain;
use Carbon\Carbon;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        Domain::insert([
            [
                'name' => 'empresaalpha.com',
                'client_id' => 1,
                'registrar_account_id' => 1,
                'host' => 'hostgator',
                'host_user' => 'alpha_user',
                'expires_at' => Carbon::now()->addYear(),
                'status' => 'ativo',
            ],
            [
                'name' => 'startupbeta.io',
                'client_id' => 2,
                'registrar_account_id' => 2,
                'host' => 'aws',
                'host_user' => 'beta_user',
                'expires_at' => Carbon::now()->addMonths(6),
                'status' => 'ativo',
            ],
            [
                'name' => 'clientegamma.com.br',
                'client_id' => 3,
                'registrar_account_id' => 3,
                'host' => null,
                'host_user' => null,
                'expires_at' => Carbon::now()->addMonths(3),
                'status' => 'expirando',
            ],
        ]);
    }
}
