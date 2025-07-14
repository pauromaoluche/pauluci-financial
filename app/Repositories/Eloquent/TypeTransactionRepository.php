<?php

namespace App\Repositories\Eloquent;

use App\Models\TypeTransaction;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Collection;

class TypeTransactionRepository implements TypeTransactionRepositoryInterface
{

    /**
     * Retorna todos tipos de transação'.
     *
     * @return Collection Instancia do tipo transaction.
     */
    public function getAll(): Collection
    {
        return TypeTransaction::where('active', true)->get();
    }
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
