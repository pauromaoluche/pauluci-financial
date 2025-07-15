<div class="mx-auto max-w-2xl px-4 py-10 md:px-6">
    <h1 class="text-2xl font-semibold mb-6">Depósito de dinheiro</h1>
    <form wire:submit.prevent="deposit" class="space-y-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <div class="flex flex-col gap-1">
            <label for="amount" class="text-sm text-gray-600 font-medium">Valor a depositar</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-400 text-sm">R$</span>
                <input type="number" id="amount" step="0.01" placeholder="0,00" required
                    wire:model.live="form.amount"
                    class="w-full rounded-lg border-gray-300 pl-10 pr-4 py-2 ring-1 ring-inset ring-gray-200 focus:ring-blue-500">
                @error('form.amount')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <label for="account_number" class="text-sm text-gray-600 font-medium">Costa destinaria</label>
            <input type="number" id="account_number" placeholder="Ex: Conta do Itaú, carteira física..."
                wire:model.live="form.account_number"
                class="rounded-lg border-gray-300 px-3 py-2 ring-1 ring-inset ring-gray-200 focus:ring-blue-500">
            @error('form.account_number')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="pt-4">
            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-white font-medium shadow hover:bg-blue-700 focus:outline-none">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 5v14m7-7H5" />
                </svg>
                Confirmar depósito
            </button>
        </div>
    </form>
</div>
