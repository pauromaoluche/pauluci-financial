<?php

namespace App\Interfaces;

use App\DTOs\DepositDTO;
use App\Models\Transaction;

interface DepositServiceInterface
{
    /**
     * Realiza a criação de um novo usuário e suas associações.
     *
     * @param DepositDTO $data
     * @return Transaction
     */
    public function deposit(DepositDTO $data): Transaction;
}
