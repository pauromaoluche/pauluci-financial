<?php

namespace App\Interfaces;

use App\DTOs\DepositDTO;
use App\DTOs\TransferDTO;

interface TransactionJobDispatcherInterface
{
    public function ProcessDepositJob(DepositDTO $data): void;

    public function dispatchConfirmationJob(int $transactionId, string $queue): void;

    public function ProcessTransferJob(TransferDTO $data): void;
}
