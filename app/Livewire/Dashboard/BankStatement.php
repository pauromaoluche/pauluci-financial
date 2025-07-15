<?php

namespace App\Livewire\Dashboard;

use App\Models\Account;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BankStatement extends Component
{
    public ?Collection $transactions;
    protected TransactionRepositoryInterface $transactionRepository;
    protected AccountRepositoryInterface $accountRepository;
    public Account $account;
    public ?float $credits = 0;
    public ?float $debits = 0;

    public function boot(TransactionRepositoryInterface $transactionRepository, AccountRepositoryInterface $accountRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->accountRepository = $accountRepository;
    }

    public function mount()
    {
        $this->transactions = $this->transactionRepository->bankStatement(Auth::id(), 100);
        $this->account = $this->accountRepository->findByUserId(Auth::id());

        foreach ($this->transactions as $item) {
            if ($item->recipient_account_number === $this->account->account_number) {
                $this->credits += $item->amount;
            } elseif ($item->sender_account_number === $this->account->account_number) {
                $this->debits += $item->amount;
            }
        }
    }
    public function render()
    {
        return view('livewire.dashboard.bank-statement')->layout('layouts.dashboard');
    }
}
