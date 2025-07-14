<?php

namespace App\Interfaces;

use App\DTOs\CreateTransactionStatusHistoryDTO;
use App\Models\TransactionStatusHistory;

interface TransactionStatusHistoryInterface
{
    /**
     * Realiza a criação novo log de transação.
     *
     * @param CreateTransactionStatusHistoryDTO $data
     * @return TransactionStatusHistory
     */
    public function createTransactionHistory(CreateTransactionStatusHistoryDTO $data): TransactionStatusHistory;
}
