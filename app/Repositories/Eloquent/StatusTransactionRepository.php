<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Models\StatusTransaction;
use App\Models\TypeTransaction;
use App\Models\User;
use App\Repositories\StatusTransactionRepositoryInterface;

class StatusTransactionRepository implements StatusTransactionRepositoryInterface
{
    /**
     * Retorna informações do status pendente.
     *
     * @return StatusTransaction A instância da conta recém-criada.
     */
    public function pendingStatus(): StatusTransaction
    {
        return StatusTransaction::find(1);
    }
}
