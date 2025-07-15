<?php

namespace App\Services;

use App\DTOs\RefundRequestDTO;
use App\Interfaces\RefundNotificationServiceInterface;
use App\Interfaces\RefundRequestServiceInterface;
use App\Models\RefundRequests;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\RefundRequestRepositoryInterface;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RefundRequestService implements RefundRequestServiceInterface
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected RefundRequestRepositoryInterface $refundRequestRepository,
        protected RefundNotificationServiceInterface $refundNotificationService,
        protected AccountRepositoryInterface $accountRepository,
        protected TransactionJobDispatcherService $transactionJobDispatcher,
        protected StatusTransactionRepositoryInterface $statusTransactionRepository,
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function refundRequest(RefundRequestDTO $data): RefundRequests
    {

        $transaction = $this->transactionRepository->findById($data->transaction_id);
        $account = $this->accountRepository->findByAccountNumber($data->requester_account_number);
        $status = $this->statusTransactionRepository->findById($data->status_transaction_id);

        if (!$status) {
            throw ValidationException::withMessages([
                'error' => ['Usuario para reembolso nao encontrado.']
            ]);
        }

        if (!$account) {
            throw ValidationException::withMessages([
                'error' => ['Usuario para reembolso nao encontrado.']
            ]);
        }

        if (!$transaction) {
            throw ValidationException::withMessages([
                'error' => ['Transação não existe.']
            ]);
        }

        if ($transaction->created_at->diffInHours(now()) >= 24) {
            throw ValidationException::withMessages([
                'warning' => ['Essa transação tem mais de 24 horas e não pode ser reembolsada.']
            ]);
        }

        return DB::transaction(function () use ($data, $account) {

            $refundRequest = $this->refundRequestRepository->create($data);

            $user = $this->userRepository->findById($account->user_id);

            $this->refundNotificationService->sendEmailRefundRequest($refundRequest->id, $user);

            return $refundRequest;
        });
    }
}
