<?php

namespace App\Repositories\Eloquent;

use App\Models\StatusTransaction;

use App\Repositories\StatusTransactionRepositoryInterface;

class StatusTransactionRepository implements StatusTransactionRepositoryInterface
{
    /**
     * Retorna informações do status pendente.
     *
     * @return StatusTransaction A instância do status transaction.
     */
    public function pendingStatus(): StatusTransaction
    {
        return StatusTransaction::find(1);
    }
}
