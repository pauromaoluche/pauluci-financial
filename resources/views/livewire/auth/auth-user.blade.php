<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8 sm:p-10 space-y-6 ring-1 ring-gray-100">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="text-center">
            <svg class="mx-auto h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16v3H4zM3 8h18v2H3zM4 12h16v8H4z" />
            </svg>
            <h1 class="mt-3 text-2xl font-bold text-gray-800">
                {{ $mode === 'register' ? 'Crie sua conta' : 'Faça login' }}</h2>
            </h1>
            <p class="mt-1 text-sm text-gray-500">Leva menos de um minuto para começar a usar o MyBank</p>
        </div>

        <form wire:submit.prevent="{{ $mode === 'register' ? 'register' : 'login' }}" class="space-y-4">
            @if ($mode === 'register')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600">Nome completo</label>
                    <input type="text" id="name" name="name" required wire:model.live="form.name"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('form.name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif
            @if ($mode === 'register')
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">E-mail</label>
                    <input type="email" id="email" name="email" required wire:model.live="form.email"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('form.email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @else
                <div>
                    <label for="login_email" class="block text-sm font-medium text-gray-600">E-mail</label>
                    <input type="email" id="login_email" name="login_email" required wire:model.defer="login_email"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('login_email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if ($mode === 'register')
                <div>
                    <label for="cpf" class="block text-sm font-medium text-gray-600">CPF</label>
                    <input type="text" id="cpf" name="cpf" required wire:model.live="form.cpf"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('form.cpf')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif
            @if ($mode === 'register')
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">Senha</label>
                    <input type="password" id="password" name="password" required wire:model.defer="form.password"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('form.password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar
                        senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required required
                        wire:model.defer="form.password_confirmation"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="text-sm text-gray-600">
                    <label class="inline-flex items-start gap-2">
                        <input type="checkbox" name="terms" required
                            class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span>
                            Eu li e aceito os
                            <a href="#" class="text-blue-600 hover:underline">termos e condições</a>.
                        </span>
                    </label>
                </div>
            @else
                <div>
                    <label for="login_password" class="block text-sm font-medium text-gray-600">Senha</label>
                    <input type="password" id="login_password" name="login_password" required
                        wire:model.defer="login_password"
                        class="mt-1 w-full rounded-xl border-gray-300 px-4 py-2.5 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('login_password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if ($mode === 'register')
                <button type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-white font-semibold shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="register">Criar conta</span>
                    <span wire:loading wire:target="register">Registrando...</span>
                </button>
            @else
                <button type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-white font-semibold shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="register">Logar</span>
                    <span wire:loading wire:target="register">Registrando...</span>
                </button>
            @endif

        </form>
        <div class="text-center text-sm text-gray-500 pt-4">
            {{ $mode === 'register' ? 'Já' : 'Não' }} tem uma conta?
            <a class="text-blue-600 font-medium hover:underline"wire:click.prevent="$set('mode', '{{ $mode === 'register' ? 'login' : 'register' }}')"
                class="text-yellow-600 dark:text-yellow-400 hover:underline">{{ $mode === 'register' ? 'Logar' : 'Registrar' }}</a>
        </div>
    </div>
</div>
