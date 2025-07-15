<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Account;

interface AccountRepositoryInterface
{
    public function createForUser(User $user, string $accountNumber): Account;
    public function findByAccountNumber(string $accountNumber): ?Account;
    public function findByUserId(string $userId): ?Account;
    public function update(Account $account): Account;
}
