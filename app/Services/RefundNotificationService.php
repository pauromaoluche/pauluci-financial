<?php

namespace App\Services;

use App\Interfaces\RefundNotificationServiceInterface;
use App\Models\User;
use App\Notifications\RefundRequest;

class RefundNotificationService implements RefundNotificationServiceInterface
{
    public function sendEmailRefundRequest(int $refundId, User $user): void
    {
        $user->notify(new RefundRequest($refundId, $user));
    }
}
