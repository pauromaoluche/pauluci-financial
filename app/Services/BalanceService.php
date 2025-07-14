<?php

namespace App\Services;

use App\Interfaces\BalanceServiceInterface;
use App\Models\Account;
use App\Repositories\AccountRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BalanceService implements BalanceServiceInterface
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
    ) {
    }

    public function add(Account $data, float $amount): Account
    {
        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'amount' => ['O valor do deposito deve ser positivo.']
            ]);
        }

        return DB::transaction(function () use ($data, $amount) {
            // Recarregar a conta para garantir que estamos trabalhando com os dados mais recentes
            $account = $this->accountRepository->findByAccountNumber($data->account_number);

            if (!$account || !$account->active) {
                throw ValidationException::withMessages([
                    'warning' => ["Conta destino #{$account->account_number} não encontrada ou inativa."]
                ]);
            }

            $account->balance += $amount;

            return $this->accountRepository->update($account);
        });
    }

    public function remove(Account $data, float $amount): Account
    {
        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'warning' => ['O valor a ser removido deve ser positivo.']
            ]);
        }

        return DB::transaction(function () use ($data, $amount) {
            $account = $this->accountRepository->findByAccountNumber($data->id);

            if (!$account->active) {
                throw ValidationException::withMessages([
                    'warning' => ['A conta esta inativa.']
                ]);
            }

            // Não permite remover saldo caso o saldo atual seja insuficente ou negativo
            if ($account->balance < $amount) {
                throw ValidationException::withMessages([
                    'warning' => ['Seu saldo atual é de ' . $account->balance . ', para fazer a transferencia de ' . $amount . ', deposite ' . ($account->balance - $amount) . ' R$']
                ]);
            }

            $account->balance += $amount;

            return $this->accountRepository->update($account);
        });
    }
}
