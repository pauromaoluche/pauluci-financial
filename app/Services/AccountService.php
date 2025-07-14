<?php

namespace App\Services;

use App\Interfaces\AccountServiceInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Models\Account;
use App\Models\User;

class AccountService implements AccountServiceInterface
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository
    ) {
    }

    public function createAccountForUser(User $user): Account
    {
        $accountNumber = $this->generateUniqueAccountNumber();
        return $this->accountRepository->createForUser($user, $accountNumber);
    }

    public function generateUniqueAccountNumber(): string
    {
        do {
            $number = (string) mt_rand(1000000000, 9999999999);
        } while ($this->accountRepository->findByAccountNumber($number)); // Usa o repositório
        return $number;
    }
}
