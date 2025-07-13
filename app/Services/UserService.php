<?php
// app/Services/UserService.php
namespace App\Services;

use App\Models\User;
use App\Interfaces\UserServiceInterface;
use App\Models\Account;
use App\Notifications\VerifyUserEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{

    public function createUser(array $data): User
    {
        if (User::where('email', $data['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => ['Este e-mail já está em uso.'],
            ]);
        }

        //Uso de transaction, pois se der algo errado na criação da conta
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'cpf' => $data['cpf'],
                'password' => Hash::make($data['password']),
            ]);

            //Gera o numero da conta
            $accountNumber = $this->generateUniqueAccountNumber();

            //cria a conta ligada ao usuário
            $user->account()->create([
                'account_number' => $accountNumber,
                'balance' => 0.00,
                'active' => true,
            ]);

            //envia e‑mail de verificação
            $user->notify(new VerifyUserEmail($user));

            // carrega a relação para retornar já com a conta
            return $user->load('account');
        });
    }

    /** Gera um número de conta único com 10 dígitos */
    protected function generateUniqueAccountNumber(): string
    {
        do {
            $number = (string) mt_rand(1000000000, 9999999999);
        } while (Account::where('account_number', $number)->exists());

        return $number;
    }
}
