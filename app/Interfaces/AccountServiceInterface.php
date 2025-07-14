<?php

namespace App\Interfaces;

use App\Models\Account;
use App\Models\User;

interface AccountServiceInterface
{
    public function createAccountForUser(User $user): Account;
    public function generateUniqueAccountNumber(): string;
}
