<?php

namespace App\Strategies;

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

class TransferConfirmationStrategy implements TransactionConfirmationStrategyInterface
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
                'error' => ['Esta transação já foi processada ou não pode ser confirmada.']
            ]);
        }

        $senderAccount = $this->accountRepository->findByAccountNumber($transaction->sender_account_number);
        $recipientAccount = $this->accountRepository->findByAccountNumber($transaction->recipient_account_number);

        if ($transaction->type_transaction_id == 2) {
            $this->balanceService->remove($senderAccount, $transaction->amount);
        } else {
            $this->balanceService->removeCredit($senderAccount, $transaction->amount);
        }

        $this->balanceService->add($recipientAccount, $transaction->amount);

        $completedStatus = $this->statusTransactionRepository->completedStatus();

        $transaction->status_transaction_id = $completedStatus->id;
        $transaction->description = $completedStatus->description;
        $this->transactionRepository->update($transaction);

        return $transaction;
    }
}
