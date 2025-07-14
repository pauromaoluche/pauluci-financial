<?php

namespace App\Services;

use App\DTOs\DepositDTO;
use App\Interfaces\TransactionJobDispatcherInterface;
use App\Jobs\ConfirmTransactionJob;
use App\Jobs\ProcessDepositJob;

class TransactionJobDispatcherService implements TransactionJobDispatcherInterface
{
    public function ProcessDepositJob(DepositDTO $data): void
    {
        ProcessDepositJob::dispatch($data);
    }

    public function dispatchConfirmationJob(int $transactionId, string $queue): void
    {
        ConfirmTransactionJob::dispatch($transactionId, $queue);
    }
}
