<?php

namespace App\Livewire;

use App\Interfaces\UserServiceInterface;
use App\Livewire\Forms\AuthUserForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AuthUser extends Component
{
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

            $user = $this->userService->createUser($this->form->all());

            // Loga o usuário após o registro
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
    public function render()
    {
        return view('livewire.auth-user')->layout('layouts.home');
    }
}
