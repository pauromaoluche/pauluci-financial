<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionStatusHistory;

interface TransactionStatusHistoryRepositoryInterface
{
    public function createTransactionHistory(Transaction $data): TransactionStatusHistory;
}
