<?php

namespace App\Livewire\Dashboard;

use App\Models\Account;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public ?Collection $transactions;
    protected TransactionRepositoryInterface $transactionRepository;
    protected AccountRepositoryInterface $accountRepository;
    public Account $account;

    public function boot(TransactionRepositoryInterface $transactionRepository, AccountRepositoryInterface $accountRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->accountRepository = $accountRepository;
    }

    public function mount()
    {
        $this->transactions = $this->transactionRepository->bankStatement(Auth::id(), 4);
        $this->account = $this->accountRepository->findByUserId(Auth::id());
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard')->layout('layouts.dashboard');
    }
}
