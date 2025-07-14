<?php

namespace App\Services;

use App\DTOs\CreateTransactionStatusHistoryDTO;
use App\DTOs\TransactionDTO;
use App\Interfaces\TransactionServiceInterface;
use App\Interfaces\TransactionStatusHistoryInterface;
use App\Models\Transaction;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Validation\ValidationException;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected TransactionStatusHistoryInterface $transactionStatusHistory,
        protected AccountRepositoryInterface $accountRepository
    ) {
    }

    public function createTransaction(TransactionDTO $data): Transaction
    {

        $account = $this->accountRepository->findByAccountNumber($data->accountNumber);

        if (!$account) {
            throw ValidationException::withMessages([
                'account' => ['Conta para deposito não existe.']
            ]);
        }

        $transaction = $this->transactionRepository->createTransaction($data);

        $this->transactionStatusHistory->createTransactionHistory(
            new CreateTransactionStatusHistoryDTO(
                transaction_id: $transaction->id,
                status_transaction_id: $transaction->status_transaction_id,
                message: $transaction->description
            )
        );

        return $transaction;
    }
}
