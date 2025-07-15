<?php

namespace App\DTOs;

class RefundRequestDTO
{
    public function __construct(
        public string $transaction_id,
        public string $requester_account_number,
        public string $status_transaction_id
    ) {
    }
}
