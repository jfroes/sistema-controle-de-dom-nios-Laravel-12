<x-layouts.main-layout title="Detalhes do Registrador">
    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Registrador: {{$registrar->name}}</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Visão geral de contas e sites relacionados.</p>
            </div>
            <a href="{{ route('registrars.edit', $registrar) }}" class="{{ $ui['btnSecondary'] }}">Editar registrador</a>
        </header>

        <section class="grid md:grid-cols-3 gap-4">
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Website</p>
                    <p class="text-sm text-slate-800 mt-1">{{$registrar->website ?? 'Não cadastrado.'}}</p>
                </div>
            </article>
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Contas do registrador</p>
                    <p class="text-2xl font-semibold text-slate-900 mt-1">{{ $registrar->accounts->count() }}</p>
                </div>
            </article>
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Domínios vinculados</p>
                    <p class="text-2xl font-semibold text-slate-900 mt-1">{{$registrar->domains->count()}}</p>
                </div>
            </article>
        </section>

        @livewire('registrars.table_show', ['registrar' => $registrar])
    </div>
</x-layouts.main-layout>
