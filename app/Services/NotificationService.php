<?php

namespace App\Services;

use App\Interfaces\NotificationServiceInterface;
use App\Models\User;
use App\Notifications\VerifyUserEmail;

class NotificationService implements NotificationServiceInterface
{
    public function sendEmailVerificationNotification(User $user): void
    {
        $user->notify(new VerifyUserEmail($user));
    }
}
