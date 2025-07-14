<?php

namespace Database\Seeders;

use App\Models\TypeTransaction;
use Illuminate\Database\Seeder;

class TypeTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeTransaction::insert([
            ['name' => 'deposit', 'description' => 'Depósito Bancario.', 'active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'transfer_in', 'description' => 'Transferencia Bancaria.', 'active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
