<x-layouts.main-layout title="Domínios">

    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Domínios</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Cadastre e gerencie domínios vinculados aos clientes.</p>
            </div>
            <a href="{{ route('domains.create') }}" class="{{ $ui['btnPrimary'] }}">Novo domínio</a>
        </header>

        @livewire('domains.table_index')

    </div>
</x-layouts.main-layout>
