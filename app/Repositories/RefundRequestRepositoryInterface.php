<?php

namespace App\Repositories;

use App\DTOs\RefundRequestDTO;
use App\Models\RefundRequests;

interface RefundRequestRepositoryInterface
{
    public function create(RefundRequestDTO $data): RefundRequests;
    public function findById(string $refundId): ?RefundRequests;
    public function update(RefundRequests $refund): RefundRequests;
}
