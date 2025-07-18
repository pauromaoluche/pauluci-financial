<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Interfaces\TransactionConfirmationStrategyInterface;
use App\Interfaces\TransactionServiceInterface;
use App\Interfaces\TransactionStatusHistoryInterface;
use App\Jobs\ConfirmTransactionJob;
use App\Models\Transaction;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected TransactionStatusHistoryInterface $transactionStatusHistory,
        protected AccountRepositoryInterface $accountRepository,
        protected TransactionJobDispatcherService $transactionJobDispatcher,
        protected StatusTransactionRepositoryInterface $statusTransactionRepository
    ) {
    }

    public function createTransaction(TransactionDTO $data, $queue): Transaction
    {

        $account = $this->accountRepository->findByAccountNumber($data->accountNumber);

        if (!$account) {
            throw ValidationException::withMessages([
                'account' => ['Conta para deposito não existe.']
            ]);
        }

        if (!$account->active) {
            throw ValidationException::withMessages([
                'warning' => ['A conta esta inativa.']
            ]);
        }

        $transaction = $this->transactionRepository->createTransaction($data);

        $this->transactionStatusHistory->createTransactionHistory($transaction);

        $this->transactionJobDispatcher->dispatchConfirmationJob($transaction->id, $queue);

        return $transaction;
    }

    public function confirmTransaction(int $transactionId): Transaction
    {
        $transaction = $this->transactionRepository->findById($transactionId);

        if (!$transaction) {
            throw ValidationException::withMessages([
                'account' => ['Conta para deposito não existe.']
            ]);
        }

        try {
            return DB::transaction(function () use ($transaction) {
                $strategy = app()->make(TransactionConfirmationStrategyInterface::class, [
                    'type_transaction_id' => $transaction->type_transaction_id
                ]);


                $confirmedTransaction = $strategy->confirm($transaction);

                $this->transactionStatusHistory->createTransactionHistory($confirmedTransaction);

                return $confirmedTransaction;
            });
        } catch (\Exception $e) {
            $failedStatus = $this->statusTransactionRepository->findById(3);

            $transaction->status_transaction_id = $failedStatus->id;
            $transaction->description = $failedStatus->description;
            $transaction->error_message = $e->getMessage();
            $this->transactionRepository->update($transaction);

            $this->transactionStatusHistory->createTransactionHistory($transaction);

            return $transaction;
        }
    }
}
