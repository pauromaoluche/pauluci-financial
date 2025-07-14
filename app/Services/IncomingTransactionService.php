<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Interfaces\IncomingTransactionServiceInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Models\Transaction;

class IncomingTransactionService implements IncomingTransactionServiceInterface
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository
    ) {
    }

    public function incomingTransaction(TransactionDTO $data): Transaction
    {

        $pending  = $this->transactions->pendingStatus();
        $depositT = $this->transactions->depositType();

        $tx = $this->transactions->createIncoming(
            account: $account,
            typeId: $depositT->id,
            amount: $data->amount,
            statusId: $pending->id,
            desc: $pending->description,
            batchId: (string) Str::uuid(),
        );
    }
}
