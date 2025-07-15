<?php

namespace App\Repositories;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use Illuminate\Support\Collection;

interface TransactionRepositoryInterface
{
    public function createTransaction(TransactionDTO $data): Transaction;
    public function findById(int $id): ?Transaction;
    public function bankStatement(int $userId, int $limit): Collection;
    public function update(Transaction $data): Transaction;
}
