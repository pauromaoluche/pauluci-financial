<?php

namespace App\DTOs;

class TransactionDTO
{
    public function __construct(
        public string $accountNumber,
        public ?int $sender_account_number,
        public ?int $recipient_account_number,
        public int $type_transaction_id,
        public float $amount,
        public int $status_transaction_id,
        public string $description,
        public ?string $error_message,
        public string $batch_id
    ) {
    }
}
