<?php

namespace App\Livewire\Transaction;

use App\DTOs\TransferDTO;
use App\Interfaces\TransactionJobDispatcherInterface;
use App\Livewire\Forms\Transaction\TransferForm;
use App\Models\User;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Transfer extends Component
{
    public Collection $transactionTypes;
    protected TransactionJobDispatcherInterface $transactionJobDispatcher;
    public User $user;

    public TransferForm $form;

    public function boot(TransactionJobDispatcherInterface $transactionJobDispatcher, TypeTransactionRepositoryInterface $typeTransactionRepository)
    {
        $this->transactionTypes = $typeTransactionRepository->findByIds([2, 3]);
        $this->transactionJobDispatcher = $transactionJobDispatcher;
        $this->user = Auth::user()->load('account');
    }

    public function transfer()
    {
        try {
            $this->form->validate();

            $this->transactionJobDispatcher->ProcessTransferJob(new TransferDTO(
                sender_account_number: $this->user->account->account_number,
                recipient_account_number: $this->form->account_number,
                type_transaction_id: $this->form->type_transaction_id,
                amount: $this->form->amount
            ));
        } catch (ValidationException $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.transaction.transfer')->layout('layouts.dashboard');
    }
}
