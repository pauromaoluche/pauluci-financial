<?php

namespace App\Interfaces;

use App\DTOs\RefundRequestDTO;
use App\Models\RefundRequests;

interface RefundRequestServiceInterface
{
    /**
     * Realiza a solicitação de reembolso
     *
     * @param RefundRequestDTO $data
     * @return RefundRequests
     */
    public function refundRequest(RefundRequestDTO $data): RefundRequests;

}
