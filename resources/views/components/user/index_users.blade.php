<x-layouts.main-layout title="Usuários">
    @aware(['ui'])

    <div class="space-y-6">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Usuários</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Gerencie os usuários administrativos do sistema.</p>
            </div>
            <a href="{{route('users.create')}}" class="{{ $ui['btnPrimary'] }}">Adicionar usuário</a>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }} space-y-4">
                <div class="flex flex-wrap gap-2">
                    <button class="{{ $ui['filterBtnActive'] }}" type="button">Todos</button>
                    <button class="{{ $ui['filterBtn'] }}" type="button">Ativos</button>
                    <button class="{{ $ui['filterBtn'] }}" type="button">Inativos</button>
                </div>

                <div>
                    <label for="search" class="{{ $ui['label'] }}">Pesquisar</label>
                    <input id="search" type="search" class="{{ $ui['input'] }}" placeholder="Buscar por nome ou email"/>
                </div>
            </div>
        </section>

        <section class="{{ $ui['tableWrap'] }}">
            <table class="{{ $ui['table'] }}">
                <thead>
                <tr>
                    <th class="{{ $ui['th'] }}">Nome</th>
                    <th class="{{ $ui['th'] }}">Email</th>
                    <th class="{{ $ui['th'] }}">Perfil</th>
                    <th class="{{ $ui['th'] }}">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="{{ $ui['td'] }}"><a href="{{route('users.show', $user)}}"
                                                       class="font-medium text-slate-900 hover:underline">{{$user->full_name}}</a>
                        </td>
                        <td class="{{ $ui['td'] }}">{{$user->email}}</td>
                        <td class="{{ $ui['td'] }}"><span class="inline-flex rounded-full bg-{{ $user->role->color() }}-100 px-2.5 py-1 text-xs font-medium text-{{ $user->role->color() }}-700">{{$user->role->label()}}</span></td>
                        <td class="{{ $ui['td'] }}"><span
                                class="inline-flex rounded-full bg-{{ $user->status->color() }}-100 px-2.5 py-1 text-xs font-medium text-{{ $user->status->color() }}-700">{{$user->status->label()}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</x-layouts.main-layout>
