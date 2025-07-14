<?php

namespace App\Livewire\Transaction;

use App\DTOs\DepositDTO;
use App\Interfaces\TransactionJobDispatcherInterface;
use App\Livewire\Forms\Transaction\DepositForm;
use App\Models\User;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Deposit extends Component
{
    public Collection $transactionTypes;
    protected TransactionJobDispatcherInterface $transactionJobDispatcher;
    public User $user;

    public DepositForm $form;

    public function boot(TransactionJobDispatcherInterface $transactionJobDispatcher, TypeTransactionRepositoryInterface $typeTransactionRepository)
    {
        $this->transactionTypes = $typeTransactionRepository->getAll();
        $this->transactionJobDispatcher = $transactionJobDispatcher;
        $this->user = Auth::user()->load('account');
    }

    public function deposit()
    {
        try {
            $this->form->validate();

            $this->transactionJobDispatcher->ProcessDepositJob(new DepositDTO(
                accountNumber:  $this->form->account_number,
                amount:  $this->form->amount,
            ));
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.transaction.deposit')->layout('layouts.dashboard');
    }
}
