<div class="mx-auto max-w-7xl px-4 py-8 md:px-6 space-y-10">

    <h1 class="text-2xl font-semibold">Extrato bancário</h1>

    <!-- Resumo financeiro ------------------------------------------------->
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-2">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Créditos no período</p>
            <p class="mt-2 text-2xl font-semibold text-green-600">+R$ {{ number_format($credits, 2, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Débitos no período</p>
            <p class="mt-2 text-2xl font-semibold text-red-600">-R$ {{ number_format($debits, 2, ',', '.') }}</p>
        </div>
    </section>

    <button wire:click="refund">
        teste
    </button>

    <!-- Lista de transações ---------------------------------------------->
    <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 space-y-6">
        <h2 class="text-lg font-medium">Transações</h2>

        <ul class="space-y-3">

            @if ($transactions->isNotEmpty())
                @foreach ($transactions as $item)
                    <li
                        class="flex items-center justify-between rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                💳
                            </span>
                            <div>
                                {{-- Verifica se a transação tem uma conta de remetente --}}
                                @if ($item->type_transaction_id == 2 || $item->type_transaction_id == 3)
                                    <p class="font-medium">
                                        @if ($item->recipient_account_number == $account->account_number)
                                            Remetente: {{ $item->senderAccount->user->name }} - Conta
                                            #{{ $item->senderAccount->account_number }}
                                        @else
                                            Destinatario: {{ $item->recipientAccount->user->name }} - Conta
                                            #{{ $item->recipientAccount->account_number }}
                                        @endif
                                    </p>
                                @else
                                    <p class="font-medium">
                                        Remetente: {{ $item->typeTransaction->description }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500">
                                    {{ $item->created_at->diffForHumans() }} •
                                    {{ $item->typeTransaction->description }} --
                                    {{ $item->statusTransaction->description }}
                                </p>
                            </div>
                        </div>
                        @if ($item->recipient_account_number == $account->account_number)
                            <span class="font-medium text-green-600">+R$
                                {{ number_format($item->amount, 2, ',', '.') }}</span>
                        @else
                            <span class="font-medium text-red-600">-R$
                                {{ number_format($item->amount, 2, ',', '.') }}</span>
                        @endif

                    </li>
                @endforeach
            @else
                <p>Nenhuma transação encontrada.</p>
            @endif
        </ul>
    </section>
</div>
