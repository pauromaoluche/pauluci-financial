<?php

namespace App\DTOs;

class CreateTransactionStatusHistoryDTO
{
    public function __construct(
        public int $transaction_id,
        public int $status_transaction_id,
        public string $message
    ) {
    }
}
