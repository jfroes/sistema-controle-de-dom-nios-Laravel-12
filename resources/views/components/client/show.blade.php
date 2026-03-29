<x-layouts.main-layout title="Detalhes do Cliente">
    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Cliente: {{$client->name}}</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Visão consolidada de dados e domínios do cliente.</p>
            </div>
            <a href="{{ url('admin/clientes/1/edit') }}" class="{{ $ui['btnSecondary'] }}">Editar cliente</a>
        </header>

        <section class="grid md:grid-cols-3 gap-4">
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Total de domínios</p>
                    <p class="text-2xl font-semibold text-slate-900 mt-1">{{$client->domains->count()}}</p>
                </div>
            </article>
        </section>

        @livewire('client.client_domains_table', ['client' => $client])
    </div>
</x-layouts.main-layout>
