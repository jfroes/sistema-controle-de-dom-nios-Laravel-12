<x-layouts.main-layout title="Contas de Registradores">

    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Contas de registrador</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Gerencie credenciais por registrador para vinculação dos domínios.</p>
            </div>
            <a href="{{ route('registrar_accounts.create') }}" class="{{ $ui['btnPrimary'] }}">Nova conta</a>
        </header>
    @livewire('registrar_accounts.table_index')
    </div>
</x-layouts.main-layout>
