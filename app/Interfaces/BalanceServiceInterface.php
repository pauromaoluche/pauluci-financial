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

    /**
     * Remove valor da conta, mas caso não tiver o valor, é removido do mesmo jeito, e fica com saldo negativo.
     *
     * @param Account $account
     * @param float $amount
     * @return Account
     */
    public function removeCredit(Account $account, float $amount): Account;
}
