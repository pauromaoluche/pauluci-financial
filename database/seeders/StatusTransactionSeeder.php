<?php

namespace Database\Seeders;

use App\Models\StatusTransaction;
use Illuminate\Database\Seeder;

class StatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusTransaction::insert([
            ['name' => 'pending', 'description' => 'Transação pendente, aguarde.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'completed', 'description' => 'Transação completa.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'failed', 'description' => 'Ocorre um erro na transação, por favor, verifique se o valor esta na conta.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reversed', 'description' => 'Transação revertida, devido solicitação ou problema do sistema.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
