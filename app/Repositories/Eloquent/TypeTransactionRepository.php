<?php

namespace App\Repositories\Eloquent;

use App\Models\TypeTransaction;
use App\Repositories\TypeTransactionRepositoryInterface;

class TypeTransactionRepository implements TypeTransactionRepositoryInterface
{
    /**
     * Retorna informações do tipo 'deposito'.
     *
     * @return TypeTransaction Instancia do tipo transaction.
     */
    public function depositType(): TypeTransaction
    {
        return TypeTransaction::find(1);
    }
}
