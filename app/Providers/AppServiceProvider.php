<?php

namespace App\Providers;

use App\Interfaces\AccountServiceInterface;
use App\Interfaces\BalanceServiceInterface;
use App\Interfaces\DepositServiceInterface;
use App\Interfaces\NotificationServiceInterface;
use App\Interfaces\TransactionConfirmationStrategyInterface;
use App\Interfaces\TransactionJobDispatcherInterface;
use App\Interfaces\TransactionServiceInterface;
use App\Interfaces\TransactionStatusHistoryInterface;
use App\Interfaces\TransferServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\StatusTransactionRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Repositories\Eloquent\TransactionStatusHistoryRepository;
use App\Repositories\Eloquent\TypeTransactionRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\StatusTransactionRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\TransactionStatusHistoryRepositoryInterface;
use App\Repositories\TypeTransactionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\AccountService;
use App\Services\BalanceService;
use App\Services\DepositService;
use App\Services\NotificationService;
use App\Services\TransactionJobDispatcherService;
use App\Services\TransactionService;
use App\Services\TransactionStatusHistoryService;
use App\Services\TransferService;
use App\Services\UserService;
use App\Strategies\DepositConfirmationStrategy;
use App\Strategies\TransferConfirmationStrategy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(TransactionStatusHistoryRepositoryInterface::class, TransactionStatusHistoryRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);

        $this->app->bind(StatusTransactionRepositoryInterface::class, StatusTransactionRepository::class);
        $this->app->bind(TypeTransactionRepositoryInterface::class, TypeTransactionRepository::class);

        // Bindings dos Serviços
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AccountServiceInterface::class, AccountService::class);
        $this->app->bind(TransactionStatusHistoryInterface::class, TransactionStatusHistoryService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(TransactionJobDispatcherInterface::class, TransactionJobDispatcherService::class);
        $this->app->bind(DepositServiceInterface::class, DepositService::class);
        $this->app->bind(BalanceServiceInterface::class, BalanceService::class);
        $this->app->bind(TransferServiceInterface::class, TransferService::class);

        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);

        $this->app->bind(TransactionConfirmationStrategyInterface::class, function ($app, $parameters) {
            $typeTransactionId = $parameters['type_transaction_id'] ?? null;

            switch ($typeTransactionId) {
                case 1:
                    return $app->make(DepositConfirmationStrategy::class);
                case 2:
                    return $app->make(TransferConfirmationStrategy::class);
                case 3:
                    return $app->make(TransferConfirmationStrategy::class);
                default:
                    throw new \InvalidArgumentException("Nenhuma estratégia de confirmação definida para o tipo de transação ID: {$typeTransactionId}");
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
