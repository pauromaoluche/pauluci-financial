<?php

namespace App\Services;

use App\Interfaces\TransactionStatusHistoryInterface;
use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use App\Repositories\TransactionStatusHistoryRepositoryInterface;

class TransactionStatusHistoryService implements TransactionStatusHistoryInterface
{
    public function __construct(
        protected TransactionStatusHistoryRepositoryInterface $transactionStatusHistory
    ) {
    }

    public function createTransactionHistory(Transaction $data): TransactionStatusHistory
    {
        return $this->transactionStatusHistory->createTransactionHistory($data);
    }
}
