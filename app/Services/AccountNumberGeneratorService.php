<?php
namespace App\Services;

use App\Repositories\AccountRepositoryInterface;

class AccountNumberGeneratorService implements AccountNumberGeneratorInterface
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository
    ) {}

    public function generate(): string
    {
        do {
            $number = (string) random_int(1000000000, 9999999999);
        } while ($this->accountRepository->existsByNumber($number));

        return $number;
    }
}
