@aware(['ui'])

<aside class="w-72 shrink-0 bg-slate-800 text-slate-100 h-screen p-4 flex flex-col overflow-hidden">
    <div class="px-2 py-4 border-b border-slate-700 mb-4">
        <h2 class="text-lg font-semibold">Admin Domínios</h2>
        <p class="text-xs text-slate-400 mt-1">Painel administrativo</p>
    </div>

    <nav class="space-y-1 flex-1 min-h-0">
        <a href="{{route('dashboard')}}" class="{{ request()->is('*dashboard*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Dashboard
        </a>

        <a href="#" class="{{ request()->is('*clientes*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Clientes
        </a>

        <a href="#" class="{{ request()->is('*dominios*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Domínios
        </a>

        <a href="#" class="{{ request()->is('*configuracoes*') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Configurações
        </a>

        @can('user_is_admin')
        <a href="{{route('users.index')}}" class="{{ request()->is('users') ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Usuários
        </a>
        @endcan

        <a href="{{route('users.show', Auth::user())}}" class="{{ request()->is('*users/'. Auth::user()->id) ? $ui['sidebarItemActive'] : $ui['sidebarItem'] }}">
            Perfil
        </a>
    </nav>

    <span class="text-xs text-slate-400">Logado como: {{Auth::user()->email}}</span>
    <div class="mt-auto pt-4 border-t border-slate-700">
        <a href="{{route('logout')}}" class="{{ $ui['sidebarItem'] }}">
            Sair
        </a>
    </div>
</aside>
