<?php

namespace App\Jobs;

use App\Interfaces\TransactionServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;


class ConfirmTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected int $transactionId;
    public string $queue;
    /**
     * Create a new job instance.
     */
    public function __construct(int $transactionId, string $queueName = 'default')
    {
        $this->transactionId = $transactionId;
        $this->queue = $queueName;
    }

    /**
     * Execute the job.
     */
       public function handle(TransactionServiceInterface $transactionService): void
    {
        try {
            // Supondo que confirmTransaction precise apenas do ID aqui
            $transactionService->confirmTransaction($this->transactionId);
        } catch (\Exception $e) {
            report($e);
            throw $e;
        }
    }
}
