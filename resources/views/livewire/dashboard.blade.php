    <div class="mx-auto max-w-7xl space-y-8 px-4 py-6 md:px-6">

        <!-- Saudações & saldo geral -->
        <section class="space-y-4">
            <h1 class="text-2xl font-semibold">Bem‑vindo(a), Pauluci!</h1>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Cartão de saldo -->
                <div class="rounded-2xl bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white shadow-lg">
                    <p class="text-sm opacity-80">Saldo disponível</p>
                    <p class="mt-2 text-3xl font-semibold">R$ 12.345,67</p>
                    <p class="mt-1 text-xs opacity-80">Conta Corrente • 12345‑6</p>
                </div>

                <!-- Cartão de investimentos -->
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm text-gray-500">Investimentos</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-800">R$ 8.900,00</p>
                    <p class="mt-1 text-xs text-gray-400">CDB, Tesouro, Ações</p>
                </div>

                <!-- Cartão de cartão de crédito -->
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm text-gray-500">Fatura do Cartão</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-800">R$ 1.257,90</p>
                    <p class="mt-1 text-xs text-gray-400">Vencimento 20/07/2025</p>
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
                <button
                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 shadow ring-1 ring-gray-200 hover:bg-gray-50">
                    <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 10h18v4H3z" />
                    </svg>
                    Pagar Conta
                </button>
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
            <h2 class="text-lg font-medium">Últimas transações</h2>

            <ul class="space-y-3">
                <li class="flex items-center justify-between rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                            💳
                        </span>
                        <div>
                            <p class="font-medium">Supermercado Pão de Açúcar</p>
                            <p class="text-xs text-gray-500">Ontem • Cartão Débito</p>
                        </div>
                    </div>
                    <span class="font-medium text-red-600">‑R$ 150,45</span>
                </li>
                <li class="flex items-center justify-between rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                            📥
                        </span>
                        <div>
                            <p class="font-medium">Salário Empresa X</p>
                            <p class="text-xs text-gray-500">05 Jul • TED</p>
                        </div>
                    </div>
                    <span class="font-medium text-green-600">+R$ 7.000,00</span>
                </li>
                <li class="flex items-center justify-between rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100">
                            🎬
                        </span>
                        <div>
                            <p class="font-medium">Netflix</p>
                            <p class="text-xs text-gray-500">01 Jul • Cartão Crédito</p>
                        </div>
                    </div>
                    <span class="font-medium text-red-600">‑R$ 39,90</span>
                </li>
            </ul>
        </section>
    </div>
