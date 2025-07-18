<?php

namespace App\Services;

use App\DTOs\DepositDTO;
use App\DTOs\TransactionDTO;
use App\Interfaces\DepositServiceInterface;
use App\Interfaces\TransactionServiceInterface;
use App\Models\Transaction;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class DepositService implements DepositServiceInterface
{
    public function __construct(
        protected StatusTransactionRepositoryInterface $statusTransactionRepository,
        protected TypeTransactionRepositoryInterface $typeTransactionRepository,
        protected TransactionServiceInterface $transactionService,
    ) {
    }

    public function deposit(DepositDTO $data): Transaction
    {

        if ($data->amount <= 0) {
            //chamar fila e disparar evento no front
            throw ValidationException::withMessages([
                'amount' => ['O valor do deposito deve ser positivo.']
            ]);
        }

        $pendingStatus  = $this->statusTransactionRepository->pendingStatus();
        $depositType = $this->typeTransactionRepository->depositType();

        $transactionDTO = new TransactionDTO(
            accountNumber: $data->accountNumber,
            sender_account_number: null,
            recipient_account_number: $data->accountNumber,
            type_transaction_id: $depositType->id,
            amount: $data->amount,
            status_transaction_id: $pendingStatus->id,
            description: $pendingStatus->description,
            error_message: null,
            batch_id: (string) Str::uuid()
        );

        $transaction = $this->transactionService->createTransaction($transactionDTO, $depositType->name);

        return $transaction;
    }
}
