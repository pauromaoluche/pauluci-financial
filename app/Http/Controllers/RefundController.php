<?php

namespace App\Http\Controllers;

use App\Models\RefundRequests;

class RefundController extends Controller
{
    public function approve(string $id)
    {
        $refundRequest = RefundRequests::findOrFail($id);

        if ($refundRequest->status !== 'pendente') {
            return redirect('/')->with('error', 'Esta solicitação de reembolso já foi processada.');
        }

        $refundRequest->update(['status' => 'aprovado']);

        return redirect('/')->with('success', 'O reembolso foi aprovado com sucesso!');
    }

    public function deny(string $id)
    {
        $refundRequest = RefundRequests::findOrFail($id);

        if ($refundRequest->status !== 'pendente') {
            return redirect('/')->with('error', 'Esta solicitação de reembolso já foi processada.');
        }

        $refundRequest->update(['status' => 'negado', 'rejection_reason' => 'Recusado pelo destinatário']);

        return redirect('/')->with('success', 'O reembolso foi recusado com sucesso!');
    }
}
