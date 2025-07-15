    <div class="mx-auto max-w-7xl space-y-8 px-4 py-6 md:px-6">
        <section class="space-y-4">
            <h1 class="text-2xl font-semibold">Bem‑vindo(a), {{ auth()->user()->name }}</h1>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                <!-- Cartão de saldo -->
                <div class="rounded-2xl bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white shadow-lg">
                    <p class="text-sm opacity-80">Saldo disponível</p>
                    <p class="mt-2 text-3xl font-semibold">R$ {{ number_format($account->balance, 2, ',', '.') }}</p>
                    <p class="mt-1 text-xs opacity-80">Conta • {{ $account->account_number }}</p>
                </div>
            </div>
        </section>

        <!-- Ações rápidas -->
        <section class="space-y-4">
            <h2 class="text-lg font-medium">Ações rápidas</h2>
            <div class="grid gap-4 sm:grid-cols-3 max-w-md">
                <a href="{{ route('dashboard.transfer') }}"
                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 shadow ring-1 ring-gray-200 hover:bg-gray-50">
                    <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 6l4 8H8l4-8z" />
                    </svg>
                    Transferir
                </a>
                <a href="{{ route('dashboard.deposit') }}"
                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 shadow ring-1 ring-gray-200 hover:bg-gray-50">
                    <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 6l4 8H8l4-8z" />
                    </svg>
                    Depositar</a>
            </div>
        </section>

        <!-- Transações recentes -->
        <section class="space-y-4">
            <ul class="space-y-3">
                <h2 class="text-lg font-medium">Últimas transações</h2>

                @if ($transactions->isNotEmpty())
                    @foreach ($transactions as $item)
                        <li
                            class="flex items-center justify-between rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
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
                                        {{ $item->typeTransaction->description }}
                                    </p>
                                </div>
                            </div>
                            @if (
                                ($item->type_transaction_id = 2 || ($item->type_transaction_id = 1)) &&
                                    $item->recipient_account_number == $account->account_number)
                                <span class="font-medium text-green-600">+R$ {{ $item->amount }}</span>
                            @else
                                <span class="font-medium text-red-600">-R$ {{ $item->amount }}</span>
                            @endif

                        </li>
                    @endforeach
                @else
                    <p>Nenhuma transação encontrada.</p>
                @endif
            </ul>
        </section>
    </div>
