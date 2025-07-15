<?php

namespace App\Repositories\Eloquent;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected AccountRepositoryInterface $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    /**
     * Cria uma nova transaction.
     *
     * @param TransactionDTO $data O usuário para o qual a conta será criada.
     * @return Transaction A instância da conta recém-criada.
     */
    public function createTransaction(TransactionDTO $data): Transaction
    {
        $recipientAccount = $this->accountRepository->findByAccountNumber($data->recipient_account_number);
        /** @var Transaction $recipientAccount */
        return $recipientAccount->incomingTransactions()->create($data->toArray());
    }

    public function findById(int $id): ?Transaction
    {
        return Transaction::find($id);
    }

    public function bankStatement(int $userId, int $limit): Collection
    {
        $transactionSelect = [
            'id',
            'sender_account_number',
            'recipient_account_number',
            'type_transaction_id',
            'amount',
            'status_transaction_id',
            'description',
            'created_at'
        ];

        return Transaction::select($transactionSelect)
            ->where(function ($query) use ($userId) {
                $query->whereHas('senderAccount', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })->orWhereHas('recipientAccount', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            })
            ->where('status_transaction_id', '!=', 3)
            ->with([
                'senderAccount' => function ($query) {
                    $query->select(['id', 'user_id', 'account_number'])
                        ->with(['user:id,name']);
                },
                'recipientAccount' => function ($query) {
                    $query->select(['id', 'user_id', 'account_number'])
                        ->with(['user:id,name']);
                },
                'typeTransaction:id,description',
                'statusTransaction:id,description'
            ])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function update(Transaction $data): Transaction
    {
        $data->save();
        return $data;
    }
}
