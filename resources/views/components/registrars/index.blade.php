<x-layouts.main-layout title="Registradores">
    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Registradores</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Gerencie registradores e seus websites oficiais.</p>
            </div>
            <a href="{{ route('registrars.create') }}" class="{{ $ui['btnPrimary'] }}">Novo registrador</a>
        </header>

        @livewire('registrars.table_index')
    </div>
</x-layouts.main-layout>
