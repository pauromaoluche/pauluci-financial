<?php

namespace App\Livewire\Web\Auth;

use App\DTOs\CreateUserDTO;
use App\Interfaces\UserServiceInterface;
use App\Livewire\Forms\AuthUserForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AuthUser extends Component
{
    public $mode = 'login';
    public string $login_email = '';
    public string $login_password = '';

    public AuthUserForm $form;

    protected UserServiceInterface $userService;

    public function boot(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register()
    {

        try {
            $this->form->validate();

            $createUserDTO = new CreateUserDTO(
                $this->form->name,
                $this->form->email,
                $this->form->cpf,
                $this->form->password
            );

            $user = $this->userService->createUser($createUserDTO);

            Auth::login($user);
            session()->regenerate();

            session()->flash('message', 'Usuário registrado com sucesso!');
            return redirect()->to('/dashboard');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Ocorreu um erro ao registrar o usuário. Tente novamente.');
            Log::error('Erro ao registrar usuário: ' . $e->getMessage());
        }
    }

    public function login()
    {

        $this->validate([
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        if (!Auth::attempt([
            'email' => $this->login_email,
            'password' => $this->login_password,
        ])) {
            throw ValidationException::withMessages([
                'login_email' => 'O E-mail pode estar errado.',
                'login_password' => 'A senha pode estar errada.',
            ]);
        }

        session()->regenerate();

        return redirect()->route('dashboard.index');
    }
    public function render()
    {
        return view('livewire.web.auth.auth-user')->layout('layouts.home');
    }
}
