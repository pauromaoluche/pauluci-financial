<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Models\User;
use App\Repositories\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    /**
     * Cria uma nova conta para o usuário especificado.
     *
     * @param User $user O usuário para o qual a conta será criada.
     * @param string $accountNumber O número da conta a ser atribuído.
     * @return Account A instância da conta recém-criada.
     */
    public function createForUser(User $user, string $accountNumber): Account
    {
        // O método create() da relação hasOne retorna uma instância do modelo relacionado (Account)
        /** @var Account $user */
        return $user->account()->create([
            'account_number' => $accountNumber,
            'balance' => 0.00,
            'active' => true,
        ]);
    }

    /**
     * Encontra uma conta pelo seu número.
     *
     * @param string $accountNumber O número da conta a ser pesquisado.
     * @return Account|null A instância da conta se encontrada, ou null caso contrário.
     */
    public function findByAccountNumber(string $accountNumber): ?Account
    {
        return Account::where('account_number', $accountNumber)->first();
    }

    /**
     * Encontra uma conta pelo seu número.
     *
     * @param string $userId O número da conta a ser pesquisado.
     * @return Account|null A instância da conta se encontrada, ou null caso contrário.
     */
    public function findByUserId(string $userId): ?Account
    {
        return Account::where('user_id', $userId)->first();
    }


    /**
     * Metodo que salve alterações na conta
     *
     * @param Account $account O número da conta a ser pesquisado.
     * @return Account|null A instância da conta se encontrada, ou null caso contrário.
     */
    public function update(Account $account): Account
    {
        $account->save();
        return $account;
    }
}
