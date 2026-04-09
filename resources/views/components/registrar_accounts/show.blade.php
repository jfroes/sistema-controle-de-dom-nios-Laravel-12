<x-layouts.main-layout title="Detalhes da Conta">
    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Conta: {{$registrar_account->label}}</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Detalhes da conta e domínios vinculados.</p>
            </div>
            <a href="#" class="{{ $ui['btnSecondary'] }}">Editar conta</a>
        </header>

        <section class="grid md:grid-cols-4 gap-4">
            <article class="{{ $ui['card'] }} md:col-span-2">
                <div class="{{ $ui['cardBody'] }} space-y-2">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Registrador</p>
                    <p class="text-sm text-slate-900">{{$registrar_account->registrar->name}}</p>
                    <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Username</p>
                    <p class="text-sm text-slate-900">{{$registrar_account->username}}</p>
                </div>
            </article>

            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Domínios vinculados</p>
                    <p class="text-2xl font-semibold text-slate-900 mt-1">{{$registrar_account->domains->count()}}</p>
                </div>
            </article>

            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Última atualização</p>
                    <p class="text-sm text-slate-900 mt-1">{{$registrar_account->updated_at ? $registrar_account->updated_at->format('d/m/Y') : '-'}}</p>
                </div>
            </article>
        </section>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardHeader'] }}">
                <h2 class="text-lg font-semibold text-slate-900">Notas</h2>
            </div>
            <div class="{{ $ui['cardBody'] }}">
                <p class="text-sm text-slate-700">{{$registrar_account->notes ?? 'Ainda não há notas.'}}</p>
            </div>
        </section>

        @livewire('registrar_accounts.table_show', ['registrar_account' => $registrar_account])
    </div>
</x-layouts.main-layout>
