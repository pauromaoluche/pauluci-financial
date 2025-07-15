<?php

namespace App\DTOs;

class TransferDTO
{
    public function __construct(
        public int $sender_account_number,
        public int $recipient_account_number,
        public int $type_transaction_id,
        public float $amount
    ) {
    }
}
