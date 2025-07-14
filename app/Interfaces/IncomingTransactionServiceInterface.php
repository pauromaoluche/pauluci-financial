<?php

namespace App\Interfaces;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;

interface IncomingTransactionServiceInterface
{
    /**
     * Realiza a criação de um deposito
     *
     * @param Transaction $data
     * @return Transaction
     */
    public function incomingTransaction(TransactionDTO $data): Transaction;
}
