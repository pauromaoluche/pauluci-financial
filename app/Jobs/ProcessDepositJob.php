<?php

namespace App\Jobs;

use App\DTOs\DepositDTO;
use App\Interfaces\DepositServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Validation\ValidationException;

class ProcessDepositJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $queue = 'deposits';
    public $tries = 5;
    protected $depositData;
    /**
     * Create a new job instance.
     */
    public function __construct(DepositDTO $depositDTO)
    {
        $this->depositData = $depositDTO;
    }

    /**
     * Execute the job.
     */
    public function handle(DepositServiceInterface $depositService): void
    {
        try {;
            $depositService->deposit($this->depositData);
        } catch (ValidationException $e) {
            report($e);
        } catch (\Exception $e) {
            report($e);
            throw $e;
        }
    }
}
