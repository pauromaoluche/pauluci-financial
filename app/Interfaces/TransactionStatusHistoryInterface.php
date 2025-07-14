<?php

namespace App\Interfaces;

use App\Models\Transaction;
use App\Models\TransactionStatusHistory;

interface TransactionStatusHistoryInterface
{
    /**
     * Realiza a criação novo log de transação.
     *
     * @param Transaction $data
     * @return TransactionStatusHistory
     */
    public function createTransactionHistory(Transaction $data): TransactionStatusHistory;
}
