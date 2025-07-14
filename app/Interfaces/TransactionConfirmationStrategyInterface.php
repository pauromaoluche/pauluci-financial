<?php

namespace App\Interfaces;

use App\Models\Transaction;

interface TransactionConfirmationStrategyInterface
{
    public function confirm(Transaction $transaction): Transaction;
}
