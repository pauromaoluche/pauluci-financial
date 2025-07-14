<?php

namespace App\Repositories\Eloquent;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * Cria uma nova transaction.
     *
     * @param TransactionDTO $data O usuário para o qual a conta será criada.
     * @return Transaction A instância da conta recém-criada.
     */
    public function createTransaction(TransactionDTO $data): Transaction
    {
        /** @var Transaction $account */
        return $account->incomingTransactions()->create($data);
    }

    public function findById(int $id): ?Transaction
    {
        return Transaction::find($id);
    }

    public function update(Transaction $data): Transaction
    {
        $data->save();
        return $data;
    }
}
