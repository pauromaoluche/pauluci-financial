<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\TransactionStatusHistoryRepositoryInterface;

class TransactionStatusHistoryRepository implements TransactionStatusHistoryRepositoryInterface
{

    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    /**
     * Cria uma nova transaction.
     *
     * @param Transaction $data O usuário para o qual a conta será criada.
     * @return TransactionStatusHistory A instância da conta recém-criada.
     */
    public function createTransactionHistory(Transaction $data): TransactionStatusHistory
    {
        /** @var TransactionStatusHistory $history */
        $history = $data->transactionStatusHistory()->create([
            'status_transaction_id' => $data->status_transaction_id,
            'message' => $data->description
        ]);

        return $history;
    }
}
