<?php

namespace App\Repositories;

use App\DTOs\CreateTransactionStatusHistoryDTO;
use App\Models\TransactionStatusHistory;

interface TransactionStatusHistoryRepositoryInterface
{
    public function createTransactionHistory(CreateTransactionStatusHistoryDTO $data): TransactionStatusHistory;
}
