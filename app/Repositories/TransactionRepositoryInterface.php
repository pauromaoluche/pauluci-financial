<?php

namespace App\Repositories;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function createTransaction(TransactionDTO $data): Transaction;

    public function findById(int $id): ?Transaction;
}
