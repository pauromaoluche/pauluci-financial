<?php

namespace App\Repositories;

use App\Models\TypeTransaction;

interface TypeTransactionRepositoryInterface
{
    public function depositType(): TypeTransaction;
}
