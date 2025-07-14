<?php

namespace App\Interfaces;

use App\DTOs\TransactionDTO;
use App\DTOs\UpdateTransactionDTO;
use App\Models\Transaction;

interface TransactionServiceInterface
{
    /**
     * Realiza a criação de um deposito
     *
     * @param TransactionDTO $data
     * @param string $queue
     * @return Transaction
     */
    public function createTransaction(TransactionDTO $data, string $queue): Transaction;

    /**
     * Realiza a confirmação da transação
     *
     * @param int $transactionId
     * @return Transaction
     */
    public function confirmTransaction(int $transactionId): Transaction;
}
