<?php

namespace App\Interfaces;

use App\Models\User;

interface RefundNotificationServiceInterface
{
    public function sendEmailRefundRequest(int $refundId, User $user): void;
}
