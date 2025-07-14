<?php

namespace App\Repositories\Eloquent;

use App\DTOs\CreateTransactionStatusHistoryDTO;
use App\DTOs\TransactionDTO;
use App\Interfaces\TransactionStatusHistoryInterface;
use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class TransactionStatusHistoryRepository implements TransactionStatusHistoryInterface
{

    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    /**
     * Cria uma nova transaction.
     *
     * @param CreateTransactionStatusHistoryDTO $data O usuário para o qual a conta será criada.
     * @return TransactionStatusHistory A instância da conta recém-criada.
     */
    public function createTransactionHistory(CreateTransactionStatusHistoryDTO $data): TransactionStatusHistory
    {
        $transaction = $this->transactionRepository->findById($data->transaction_id);

        /** @var TransactionStatusHistory $history */
        $history = $transaction->transactionStatusHistory()->create([
            'status_transaction_id' => $transaction->status_transaction_id,
            'message' => $transaction->description
        ]);

        return $history;
    }
}
