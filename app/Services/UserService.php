<?php

namespace App\Services;

use App\DTOs\CreateUserDTO;
use App\Repositories\UserRepositoryInterface;
use App\Interfaces\AccountServiceInterface;
use App\Interfaces\NotificationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected AccountServiceInterface $accountService,
        protected NotificationServiceInterface $notificationService
    ) {
    }

    public function createUser(CreateUserDTO $data): User
    {
        if ($this->userRepository->findByEmail($data->email)) {
            throw ValidationException::withMessages([
                'email' => ['Este e-mail já está em uso.']
            ]);
        }

        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create($data);

            $this->accountService->createAccountForUser($user);

            $this->notificationService->sendEmailVerificationNotification($user);

            return $user->load('account');
        });
    }
}
