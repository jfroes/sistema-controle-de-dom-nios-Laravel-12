<aside class="w-72 shrink-0 bg-slate-800 text-slate-100 h-screen p-4 flex flex-col overflow-hidden">
    <div class="px-2 py-4 border-b border-slate-700 mb-4">
        <h2 class="text-lg font-semibold">Admin Domínios</h2>
        <p class="text-xs text-slate-400 mt-1">Painel administrativo</p>
    </div>

    <nav class="space-y-1 flex-1 min-h-0">
        <a href="{{route('dashboard')}}" class="{{ request()->is('*dashboard*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-layout-dashboard class="{{ $ui['icon-size'] }}" />Dashboard
        </a>

        <a href="{{route('clients.index')}}" class="{{ request()->is('*clients*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-handshake class="{{ $ui['icon-size'] }}" />Clientes
        </a>

        <a href="{{route('domains.index')}}" class="{{ request()->is('*domains*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-zap class="{{ $ui['icon-size'] }}" />Domínios
        </a>

        <a href="{{route('registrars.index')}}" class="{{ request()->is('*registrars*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-book-marked class="{{ $ui['icon-size'] }}" />Registradores
        </a>

        <a href="{{route('registrar_accounts.index')}}" class="{{ request()->is('*registrar_accounts*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-cuboid class="{{ $ui['icon-size'] }}" />Contas de Registradores
        </a>

        <a href="#" class="{{ request()->is('*configuracoes*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-settings-2 class="{{ $ui['icon-size'] }}" />Configurações
        </a>

        @can('user_is_admin')
        <a href="{{route('users.index')}}" class="{{ request()->is('users') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-users class="{{ $ui['icon-size'] }}" />Usuários
        </a>
        @endcan

        <a href="{{route('users.show', Auth::user())}}" class="{{ request()->is('*users/'. Auth::user()->id) ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            <x-lucide-user-pen class="{{ $ui['icon-size'] }}" />Perfil
        </a>
    </nav>

    <span class="text-xs text-slate-400">Logado como: {{Auth::user()->email}}</span>
    <div class="mt-auto pt-4 border-t border-slate-700">
        <a href="{{route('logout')}}" class="{{ $ui['sidebarItem'] }}">
            <x-lucide-log-out class="{{ $ui['icon-size'] }} rotate-180" /> Sair
        </a>
    </div>
</aside>
