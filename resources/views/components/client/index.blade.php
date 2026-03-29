<x-layouts.main-layout title="Clientes">

    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Clientes</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Cadastre e gerencie clientes vinculados aos domínios.</p>
            </div>
            <a href="{{ route('clients.create') }}" class="{{ $ui['btnPrimary'] }}">Novo cliente</a>
        </header>

        @livewire('client.table_index')

    </div>
</x-layouts.main-layout>
