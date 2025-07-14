<?php

namespace App\Repositories\Eloquent;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

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

    public function update(Transaction $data): Transaction
    {
        $data->save();
        return $data;
    }
}
