<?php
// app/DTOs/DepositDTO.php
namespace App\DTOs;

class DepositDTO
{
    public function __construct(
        public readonly int   $accountNumber,
        public readonly float $amount
    ) {}
}
