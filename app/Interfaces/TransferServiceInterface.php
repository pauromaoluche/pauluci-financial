<?php

namespace App\Interfaces;

use App\DTOs\TransferDTO;
use App\Models\Transaction;

interface TransferServiceInterface
{
    /**
     * Realiza a criação de um novo usuário e suas associações.
     *
     * @param TransferDTO $data
     * @return Transaction
     */
    public function transfer(TransferDTO $data): Transaction;
}
