<?php

namespace App\Repositories;

use App\Models\TypeTransaction;
use Illuminate\Support\Collection;

interface TypeTransactionRepositoryInterface
{
    public function getAll(): Collection;
    public function depositType(): TypeTransaction;
    public function findById(int $id): TypeTransaction;
    public function findByIds(array $ids): Collection;
}
