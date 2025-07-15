<?php

namespace App\Interfaces;

use App\Models\Account;

interface BalanceServiceInterface
{
    /**
     * Realiza adição de valor a conta.
     *
     * @param Account $account
     * @param float $amount
     * @return Account
     */
    public function add(Account $account, float $amount): Account;

    /**
     * Remove valor da conta.
     *
     * @param Account $account
     * @param float $amount
     * @return Account
     */
    public function remove(Account $account, float $amount): Account;
}
