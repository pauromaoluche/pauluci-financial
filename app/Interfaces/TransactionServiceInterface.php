<?php

namespace App\Interfaces;

use App\Models\Transaction;
use App\Models\User;

interface TransactionServiceInterface
{
    /**
     * Realiza um depósito em uma conta.
     *
     * @param User $user
     * @param float $amount
     * @return Transaction
     * @throws \Exception
     */
    public function deposit(User $user, float $amount): Transaction;

    /**
     * Realiza uma transferência entre contas.
     *
     * @param User $senderUser
     * @param string $recipientIdentifier (numero da conta ou CPF do destinatário)
     * @param float $amount
     * @param string|null $description
     * @return array contendo as transações de débito e crédito
     * @throws \Exception
     */
    public function transfer(User $senderUser, string $recipientIdentifier, float $amount, ?string $description = null): array;

    /**
     * Tenta estornar uma transação específica ou um lote de transações.
     *
     * @param string $batchId O ID do lote de transações a ser estornado.
     * @return bool
     * @throws \Exception
     */
    public function reverseTransfer(string $batchId): bool;


    /**
     * Grava o log do passo atual da transação
     *
     * @param User $user
     * @return void
     */
    public function transactionHistory(Transaction $transaction): void;

    /**
     * Confirma se a transação funcionou
     * grava novo log na transactionHistory
     *
     * @param int confirmTransaction
     * @return Transaction
     */
    public function confirmTransaction(int $confirmTransaction): Transaction;
}
