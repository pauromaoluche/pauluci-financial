<?php

namespace App\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
    public function createUser(array $data): User;
}
