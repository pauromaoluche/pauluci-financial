{{-- resources/views/auth/verify-email.blade.php --}}
<x-app-layout> {{-- Se você tem um layout de componente, ou use @extends('app') --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Verifique seu Endereço de E-mail</h2>

            <div class="mb-4 text-sm text-gray-600">
                Obrigado por se registrar! Antes de continuar, por favor, verifique seu e-mail clicando no link que acabamos de enviar para você. Se você não recebeu o e-mail, teremos o prazer de lhe enviar outro.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Reenviar E-mail de Verificação
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
