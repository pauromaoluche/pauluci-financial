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

    public function toArray(): array
    {
        return [
            'sender_account_number' => $this->sender_account_number,
            'recipient_account_number' => $this->recipient_account_number,
            'type_transaction_id' => $this->type_transaction_id,
            'amount' => $this->amount,
            'status_transaction_id' => $this->status_transaction_id,
            'description' => $this->description,
            'error_message' => $this->error_message,
            'batch_id' => $this->batch_id,
        ];
    }
}
