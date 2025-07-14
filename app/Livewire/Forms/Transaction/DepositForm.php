<?php

namespace App\Livewire\Forms\Transaction;

use Livewire\Attributes\Rule;
use Livewire\Form;

class DepositForm extends Form
{
    #[Rule(['required', 'numeric', 'min:0.01'])]
    public $amount = 0.0;
    #[Rule(['required', 'numeric', 'digits:10', 'exists:accounts,account_number'])]
    public $account_number = '';

    public function messages(): array
    {
        return [
            'amount.required' => 'O valor é obrigatorio.',
            'amount.min' => 'O valor não pode ser menor que 0.01.',
            'amount.numeric' => 'O valor tem que ser numérico.',

            'account_number.required' => 'O número da conta é obrigatório.',
            'account_number.numeric' => 'O número da conta só pode ser números.',
            'account_number.digits' => 'O número da conta deve ter exatamente :digits dígitos.',
            'account_number.exists' => 'O número da conta informado não existe.',
        ];
    }
}
