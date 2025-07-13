<?php

namespace App\Jobs;

use App\Events\NotificationUser;
use App\Interfaces\TransactionServiceInterface;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessDeposit implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public User $user;
    public float $amount;
    public string $description;

    public int $tries = 3;
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, float $amount, string $description)
    {
        //Com withoutRelations() quando o job rodar, o Eloquent fará um
        //SELECT * FROM users WHERE id = ? fresco — sem carregar nenhuma relação extra.
        $this->user = $user->withoutRelations();
        $this->amount = $amount;
        $this->description = $description;
        // Fila específica para depósitos
        $this->onQueue('deposits');
    }


    /**
     * Execute the job.
     */
    public function handle(TransactionServiceInterface $financialService): void
    {
        try {
            $transaction = $financialService->deposit(
                $this->user,
                $this->amount,
                $this->description
            );

            // Dispara o evento de status atualizado
            event(new NotificationUser(
                $this->user,
                $transaction,
                "Depósito de R$ " . number_format($this->amount, 2, ',', '.') . " concluído com sucesso!",
                true
            ));
        } catch (Exception $e) {
            // Tenta criar uma transação falha para registrar o erro
            try {
                $account = $this->user->account;
                if ($account) {
                    $failedTransaction = $account->incomingTransactions()->create([
                        'type_transaction_id' => 1, // ID do tipo Depósito
                        'amount' => $this->amount,
                        'status_transaction_id' => 2, // ID do status Falhou
                        'description' => $this->description ?? 'Depósito falhou.',
                        'sender_account_number' => null,
                        'batch_id' => (string) Str::uuid(),
                        'error_message' => $e->getMessage(),
                    ]);
                    event(new NotificationUser(
                        $this->user,
                        $failedTransaction,
                        "Depósito de R$ " . number_format($this->amount, 2, ',', '.') . " falhou: " . $e->getMessage(),
                        false
                    ));
                }
            } catch (\Exception $e2) {
                Log::critical("Erro ao registrar transação de depósito falha: " . $e2->getMessage());
            }

            throw $e; // Re-lança para que o job seja marcado como falho
        }
    }
}
