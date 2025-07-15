<?php

namespace App\Repositories\Eloquent;

use App\DTOs\RefundRequestDTO;
use App\Models\RefundRequests;
use App\Repositories\RefundRequestRepositoryInterface;

class RefundRequestRepository implements RefundRequestRepositoryInterface
{
    public function create(RefundRequestDTO $data): RefundRequests
    {
        return RefundRequests::create([
            'transaction_id' => $data->transaction_id,
            'requester_account_number' => $data->requester_account_number,
            'status_transaction_id' => $data->status_transaction_id,
        ]);
    }

    public function findById(string $refundId): ?RefundRequests
    {
        return RefundRequests::find($refundId);
    }

    public function update(RefundRequests $refund): RefundRequests
    {
        $refund->save();
        return $refund;
    }
}
