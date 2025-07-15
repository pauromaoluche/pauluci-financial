<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\DTOs\TransferDTO;
use App\Interfaces\TransactionServiceInterface;
use App\Interfaces\TransferServiceInterface;
use App\Models\Transaction;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class TransferService implements TransferServiceInterface
{
    public function __construct(
        protected StatusTransactionRepositoryInterface $statusTransactionRepository,
        protected TypeTransactionRepositoryInterface $typeTransactionRepository,
        protected TransactionServiceInterface $transactionService,
    ) {
    }

    public function transfer(TransferDTO $data): Transaction
    {

        if ($data->amount <= 0) {
            //chamar fila e disparar evento no front
            throw ValidationException::withMessages([
                'amount' => ['O valor do deposito deve ser positivo.']
            ]);
        }

        $pendingStatus  = $this->statusTransactionRepository->pendingStatus();
        $typeTransaction = $this->typeTransactionRepository->findById($data->type_transaction_id);

        $transactionDTO = new TransactionDTO(
            accountNumber: $data->sender_account_number,
            sender_account_number: $data->sender_account_number,
            recipient_account_number: $data->recipient_account_number,
            type_transaction_id: $data->type_transaction_id,
            amount: $data->amount,
            status_transaction_id: $pendingStatus->id,
            description: $pendingStatus->description,
            error_message: null,
            batch_id: (string) Str::uuid()
        );

        $transaction = $this->transactionService->createTransaction($transactionDTO, $typeTransaction->name);

        return $transaction;
    }
}
