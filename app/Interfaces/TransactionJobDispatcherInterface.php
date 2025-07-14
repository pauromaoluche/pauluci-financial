<?php

namespace App\Interfaces;

use App\DTOs\DepositDTO;

interface TransactionJobDispatcherInterface
{
    public function ProcessDepositJob(DepositDTO $data): void;

    public function dispatchConfirmationJob(int $transactionId, string $queue): void;
}
