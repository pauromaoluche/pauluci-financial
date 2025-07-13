<?php

namespace App\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
     /**
     * Realiza a criacao de usuario e da conta.
     *
     * @param User $user
     */
    public function createUser(array $data): User;
}
