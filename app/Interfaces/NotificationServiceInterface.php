<?php

namespace App\Interfaces;

use App\Models\User;

interface NotificationServiceInterface
{
    public function sendEmailVerificationNotification(User $user): void;
}
