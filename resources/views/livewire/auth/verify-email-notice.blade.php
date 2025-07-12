{{-- resources/views/livewire/auth/verify-email-notice.blade.php --}}
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Verifique seu Endereço de E-mail</h2>

        <div class="mb-4 text-sm text-gray-600">
            Obrigado por se registrar! Antes de continuar, por favor, verifique seu e-mail clicando no link que acabamos de enviar para você. Se você não recebeu o e-mail, teremos o prazer de lhe enviar outro.
        </div>

        @if ($status)
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $status }}
            </div>
        @endif

        @error('email_resend') {{-- Para a mensagem de erro do throttle --}}
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror

        <div class="mt-4 flex items-center justify-between">
            <button wire:click="resendVerificationEmail"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="resendVerificationEmail">Reenviar E-mail de Verificação</span>
                <span wire:loading wire:target="resendVerificationEmail">Enviando...</span>
            </button>

            <button wire:click="logout"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="logout">Sair</span>
                <span wire:loading wire:target="logout">Saindo...</span>
            </button>
        </div>
    </div>
</div>
