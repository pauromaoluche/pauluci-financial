<?php

namespace App\Services;

interface AccountNumberGeneratorInterface
{
    public function generate(): string;
}
