<?php
// app/Strategies/TransactionConfirmation/DepositConfirmationStrategy.php

namespace App\Strategies\TransactionConfirmation;

use App\DTOs\UpdateTransactionDTO;
use App\Interfaces\BalanceServiceInterface;
use App\Interfaces\TransactionConfirmationStrategyInterface;
use App\Interfaces\NotificationServiceInterface;
use App\Interfaces\TransactionServiceInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DepositConfirmationStrategy implements TransactionConfirmationStrategyInterface
{
    // Injete todas as dependências que esta estratégia precisa
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected NotificationServiceInterface $notificationService,
        protected StatusTransactionRepositoryInterface $statusTransactionRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected BalanceServiceInterface $balanceService,
        protected TransactionServiceInterface $transactionService
    ) {
    }

    public function confirm(Transaction $transaction): Transaction
    {

        if ($transaction->status_transaction_id !== 1) {
            throw ValidationException::withMessages([
                'error' => ['Essa transação não existe.']
            ]);
        }

        return DB::transaction(function () use ($transaction) {
            $recipientAccount = $this->accountRepository->findByAccountNumber($transaction->recipient_account_number);

            // Lógica ESPECÍFICA de depósito
            $this->balanceService->add($recipientAccount, $transaction->amount);

            $completedStatus = $this->statusTransactionRepository->completedStatus();

            $transaction->status_transaction_id = $completedStatus->id;
            $transaction->description = $completedStatus->id;
            $this->transactionRepository->update($transaction);

            return $transaction;
        });
    }
}
