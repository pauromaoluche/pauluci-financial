<?php

namespace App\Services;

use App\DTOs\CreateTransactionStatusHistoryDTO;
use App\Interfaces\TransactionStatusHistoryInterface;
use App\Models\TransactionStatusHistory;
use App\Repositories\TransactionStatusHistoryRepositoryInterface;

class TransactionStatusHistoryService implements TransactionStatusHistoryInterface
{
    public function __construct(
        protected TransactionStatusHistoryRepositoryInterface $transactionStatusHistory
    ) {
    }

    public function createTransactionHistory(CreateTransactionStatusHistoryDTO $data): TransactionStatusHistory
    {
        return $this->transactionStatusHistory->createTransactionHistory($data);
    }
}
