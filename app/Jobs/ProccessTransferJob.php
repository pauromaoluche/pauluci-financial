<?php

namespace App\Jobs;

use App\DTOs\TransferDTO;
use App\Interfaces\TransferServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Validation\ValidationException;

class ProccessTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $transferData;
    /**
     * Create a new job instance.
     */
    public function __construct(TransferDTO $transferDTO)
    {
        $this->transferData = $transferDTO;
        $this->onQueue('transfer_in');
    }

    /**
     * Execute the job.
     */
    public function handle(TransferServiceInterface $transferService): void
    {
        try {;
            $transferService->transfer($this->transferData);
        } catch (ValidationException $e) {
            report($e);
        } catch (\Exception $e) {
            report($e);
            //throw $e;
        }
    }
}
