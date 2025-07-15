<div>
    <section class="relative isolate overflow-hidden bg-white">
        <!-- Ilustração de fundo -->
        <div aria-hidden="true" class="absolute inset-0 -z-10 bg-gradient-to-br from-blue-50 via-white to-transparent">
        </div>

        <div class="mx-auto max-w-7xl px-4 py-20 text-center md:px-6 lg:py-28">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                Tudo o que você espera de um banco. <br class="hidden sm:inline">Direto no seu bolso.
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">
                Controle seu dinheiro, invista e pague contas em segundos com a melhor experiência digital do
                mercado.
            </p>

            <!-- Botões de ação -->
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-6">
                <a href="{{ route('auth') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium shadow hover:bg-blue-700">
                    Criar conta
                </a>
                <a href="/login"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-8 py-3 font-medium shadow ring-1 ring-gray-200 hover:bg-gray-50">
                    Entrar
                </a>
            </div>
        </div>
    </section>

    <!-- Seções extras (exemplo) -->
    <section id="features" class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        <h2 class="text-center text-2xl font-semibold mb-10">Recursos que você vai amar</h2>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Recurso -->
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="font-medium text-gray-800">Pagamentos instantâneos</h3>
                <p class="mt-2 text-sm text-gray-600">Envie e receba dinheiro via PIX em segundos, 24/7.</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="font-medium text-gray-800">Cartão sem anuidade</h3>
                <p class="mt-2 text-sm text-gray-600">Crédito e débito internacional com zero tarifas escondidas.
                </p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="font-medium text-gray-800">Investimentos inteligentes</h3>
                <p class="mt-2 text-sm text-gray-600">Aplique em CDB, Tesouro Direto e ações num só clique.</p>
            </div>
        </div>
    </section>
</div>
