<?php

namespace App\Livewire\Transaction;

use App\DTOs\DepositDTO;
use App\Interfaces\TransactionJobDispatcherInterface;
use App\Models\User;
use App\Repositories\TypeTransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Deposit extends Component
{
    public Collection $transactionTypes;
    protected TransactionJobDispatcherInterface $transactionJobDispatcher;
    public User $user;

    public function boot(TransactionJobDispatcherInterface $transactionJobDispatcher, TypeTransactionRepositoryInterface $typeTransactionRepository)
    {
        $this->transactionTypes = $typeTransactionRepository->getAll();
        $this->transactionJobDispatcher = $transactionJobDispatcher;
        $this->user = Auth::user()->load('account');
    }

    public function deposit()
    {
        $this->transactionJobDispatcher->ProcessDepositJob(new DepositDTO(
            accountNumber: $this->user->account->account_number,
            amount: 400,
        ));
    }

    public function render()
    {
        return view('livewire.transaction.deposit')->layout('layouts.dashboard');
    }
}
