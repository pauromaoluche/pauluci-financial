<?php
// app/Services/UserService.php
namespace App\Services;

use App\Models\User;
use App\Interfaces\UserServiceInterface;
use App\Notifications\VerifyUserEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{

    public function createUser(array $data): User
    {
        // Validação básica
        if (User::where('email', $data['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => ['Este e-mail já está em uso.'],
            ]);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'password' => Hash::make($data['password']),
            'balance' => 0.00,
        ]);

        $user->notify(new VerifyUserEmail($user));

        return $user;
    }
}
