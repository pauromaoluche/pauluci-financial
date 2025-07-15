<?php

namespace App\Repositories;

use App\Models\StatusTransaction;

interface StatusTransactionRepositoryInterface
{
    public function pendingStatus(): StatusTransaction;
    public function completedStatus() : StatusTransaction;
    public function findById(int $id): StatusTransaction;
}
