<?php
// app/Services/UserService.php
namespace App\Services;

use App\Interfaces\TransactionServiceInterface;
use App\Jobs\ConfirmTransaction;
use App\Models\StatusTransaction;
use App\Models\Transaction;
use App\Models\TypeTransaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionService implements TransactionServiceInterface
{


    //Metodo que ira criar o primeiro deposiuto com status pendente, após isso sera confirmado se funcionou ou não
    public function deposit(User $user, float $amount): Transaction
    {
        if ($amount <= 0) {
            //chamar evento para aviso na tela
            throw new Exception('O valor do depósito deve ser positivo.');
        }

        return DB::transaction(function () use ($user, $amount) {
            $pendingStatus = StatusTransaction::where('name', 'pending')->firstOrFail();
            $typeTransaction = TypeTransaction::where('name', 'deposit')->firstOrFail();
            $account = $user->account;

            $transaction = $account->incomingTransactions()->create([
                'sender_account_number' => null,
                'type_transaction_id' => $typeTransaction->idate,
                'amount' => $amount,
                'status_transaction_id' => $pendingStatus->id,
                'description' => $pendingStatus->description,
                'batch_id' => (string) Str::uuid(),
            ]);

            $this->transactionHistory($transaction);

            ConfirmTransaction::dispatch($transaction->id, $typeTransaction->name);

            return $transaction;
        });
    }

    public function transfer(User $senderUser, string $recipientIdentifier, float $amount, ?string $description = null): array
    {
        if ($amount <= 0) {
            throw new Exception('O valor da transferência deve ser positivo.');
        }

        return DB::transaction(function () use ($senderUser, $recipientIdentifier, $amount, $description) {
            $senderAccount = $senderUser->account;

            if (!$senderAccount) {
                throw new Exception('A conta do remetente não foi encontrada.');
            }

            // Requisito: Validar se o usuário tem saldo antes da transferência
            if ($senderAccount->balance < $amount) {
                throw new Exception('Saldo insuficiente para a transferência.');
            }

            // Encontrar a conta do destinatário pelo email ou CPF
            $recipientUser = User::where('email', $recipientIdentifier)
                ->orWhere('cpf', $recipientIdentifier)
                ->first();

            if (!$recipientUser) {
                throw new Exception('Destinatário não encontrado com o e-mail ou CPF fornecido.');
            }

            $recipientAccount = $recipientUser->account;

            if (!$recipientAccount) {
                // Se o destinatário não tem conta, crie uma
                $recipientAccount = $recipientUser->account()->create(['balance' => 0.00]);
            }

            // Gerar um ID de lote único para agrupar as duas transações (débito e crédito)
            $batchId = (string) Str::uuid();

            // 1. Débito da conta do remetente
            $senderAccount->balance -= $amount;
            $senderAccount->save();

            $outgoingTransaction = $senderAccount->outgoingTransactions()->create([
                'type' => 'transfer_out',
                'amount' => $amount,
                'status' => 'completed',
                'description' => $description ?? 'Transferência para ' . ($recipientUser->name ?? $recipientUser->email),
                'recipient_account_id' => $recipientAccount->id,
                'batch_id' => $batchId,
            ]);

            // 2. Crédito na conta do destinatário
            $recipientAccount->balance += $amount;
            $recipientAccount->save();

            $incomingTransaction = $recipientAccount->incomingTransactions()->create([
                'type' => 'transfer_in',
                'amount' => $amount,
                'status' => 'completed',
                'description' => $description ?? 'Transferência de ' . ($senderUser->name ?? $senderUser->email),
                'account_id' => $senderAccount->id, // A conta de origem é a do remetente
                'batch_id' => $batchId,
            ]);

            return [
                'outgoing' => $outgoingTransaction,
                'incoming' => $incomingTransaction,
            ];
        });
    }

    public function reverseTransfer(string $batchId): bool
    {
        return DB::transaction(function () use ($batchId) {
            $transactions = Transaction::where('batch_id', $batchId)
                ->where('status', 'completed')
                ->get();

            if ($transactions->isEmpty()) {
                throw new Exception('Nenhuma transação concluída encontrada para o lote fornecido para estorno.');
            }

            foreach ($transactions as $transaction) {
                $account = $transaction->account;
                $recipientAccount = $transaction->recipientAccount;

                // Estornar a transação
                if ($transaction->type === 'transfer_out') {
                    // Recreditar o remetente
                    if ($account) {
                        $account->balance += $transaction->amount;
                        $account->save();
                    }
                } elseif ($transaction->type === 'transfer_in') {
                    // Debitar o destinatário
                    if ($account) { // Neste caso, 'account' é a conta do destinatário
                        $account->balance -= $transaction->amount;
                        $account->save();
                    }
                } elseif ($transaction->type === 'deposit') {
                    // Debitar o depositante
                    if ($account) {
                        $account->balance -= $transaction->amount;
                        $account->save();
                    }
                }

                $transaction->status = 'reversed';
                $transaction->error_message = 'Estornada por solicitação/inconsistência.';
                $transaction->save();
            }

            return true;
        });
    }

    public function transactionHistory(Transaction $transaction): void
    {
        $transaction->transactionStatusHistory()->create([
            'status_transaction_id' => $transaction->status_transaction_id,
            'message' => $transaction->description
        ]);
    }

    public function confirmTransaction($transactionId): Transaction
    {
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            //fazer disparar evento de notificação
            \Log::error("Tentativa de confirmar depósito para ID de transação inválido: {$transactionId}");
            return false;
        }

        return DB::transaction(function () use ($transactionId) {

            $account = $transaction->account;

            if (!$transaction) {
                //fazer disparar evento de notificação
                \Log::error("Tentativa de confirmar depósito para ID de transação inválido: {$transactionId}");
                return false;
            }
            $pendingStatus = StatusTransaction::where('name', 'pending')->firstOrFail();
            $account = $user->account;

            $transaction = $account->incomingTransactions()->create([
                'sender_account_number' => null,
                'type_transaction_id' => 1,
                'amount' => $amount,
                'status_transaction_id' => $pendingStatus->id,
                'description' => $pendingStatus->description,
                'batch_id' => (string) Str::uuid(),
            ]);

            $this->transactionHistory($transaction);

            return $transaction;
        });
    }
}
