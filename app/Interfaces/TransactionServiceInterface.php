<?php

namespace App\Interfaces;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;

interface TransactionServiceInterface
{
    /**
     * Realiza a criação de um deposito
     *
     * @param TransactionDTO $data
     * @return Transaction
     */
    public function createTransaction(TransactionDTO $data): Transaction;
}
