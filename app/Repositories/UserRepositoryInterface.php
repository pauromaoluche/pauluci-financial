<?php

namespace App\Repositories;

use App\DTOs\CreateUserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(CreateUserDTO $data): User;
    public function findByEmail(string $email): ?User;
    public function findById(int $id): ?User;
    public function save(User $user): User;
}
