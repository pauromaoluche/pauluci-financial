<?php

namespace App\Livewire\Web\Auth;

use App\Interfaces\NotificationServiceInterface;
use App\Notifications\VerifyUserEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class VerifyEmailNotice extends Component
{
    public string $status = '';

    protected NotificationServiceInterface $notificationService;

    public function boot(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function resendVerificationEmail()
    {
        // Verifica se o usuario esta logado
        if (!Auth::check()) {
            return redirect()->route('auth');
        }

        // Se o e-mail já foi verificado, redireciona para o dashboard
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard.index'));
        }

        try {

            $this->notificationService->sendEmailVerificationNotification(Auth::user());
            $this->status = 'Um novo link de verificação foi enviado para o seu endereço de e-mail.';
        } catch (AuthorizationException $e) {
            // Isso acontece se o middleware 'throttle' impedir o envio
            throw ValidationException::withMessages([
                'email_resend' => ['Muitas requisições. Por favor, espere um momento antes de tentar novamente.'],
            ])->redirectTo(route('verification.notice'));
        } catch (\Exception $e) {
            $this->status = 'Ocorreu um erro ao reenviar o e-mail. Tente novamente.';
            Log::error('Erro ao reenviar email de verificação: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.web.auth.verify-email-notice')->layout('layouts.home');
    }
}
