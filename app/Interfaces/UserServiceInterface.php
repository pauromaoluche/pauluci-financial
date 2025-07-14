<?php

namespace App\Interfaces;

use App\DTOs\CreateUserDTO;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * Realiza a criação de um novo usuário e suas associações.
     *
     * @param CreateUserDTO $data
     * @return User
     */
    public function createUser(CreateUserDTO $data): User;
}
