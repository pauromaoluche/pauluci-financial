<?php

namespace App\Livewire\Forms\Transaction;

use Livewire\Attributes\Rule;
use Livewire\Form;

class TransferForm extends Form
{

    #[Rule(['required', 'integer', 'exists:type_transactions,id'])]
    public int $type_transaction_id = 0;
    #[Rule(['required', 'numeric', 'min:0.01'])]
    public $amount = 0.0;
    #[Rule(['required', 'integer', 'digits:10', 'exists:accounts,account_number'])]
    public $account_number = '';
    // #[Rule(['nullable', 'string', 'max:100'])]
    // public $description = '';


    public function messages(): array
    {
        return [
            'type_transaction_id.required' => 'O tipo de transação é obrigatório.',
            'type_transaction_id.integer' => 'O tipo de transação deve ser um número inteiro.',
            'type_transaction_id.exists' => 'O tipo de transação não existe.',

            'amount.required' => 'O valor é obrigatorio.',
            'amount.min' => 'O valor não pode ser menor que 0.01.',
            'amount.numeric' => 'O valor tem que ser numérico.',

            'account_number.required' => 'O número da conta é obrigatório.',
            'account_number.integer' => 'O número da conta tem que ser um número inteiro.',
            'account_number.digits' => 'O número da conta deve ter exatamente :digits dígitos.',
            'account_number.exists' => 'O número da conta informado não existe.',
        ];
    }
}
