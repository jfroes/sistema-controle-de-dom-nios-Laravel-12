<x-layouts.main-layout title="Detalhes do Usuário">
    @aware(['ui'])

    <div class="space-y-6">
        <header>
            <h1 class="{{ $ui['title'] }}">Detalhe do usuário</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Visualize permissões e ative ou desative acessos.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }} grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-500">Nome completo</p>
                    <p class="font-medium text-slate-900">{{$user->full_name}}</p>
                </div>
                <div>
                    <p class="text-slate-500">Email</p>
                    <p class="font-medium text-slate-900">{{$user->email}}</p>
                </div>
                <div>
                    <p class="text-slate-500">Perfil</p>
                    <p class="inline-flex rounded-full bg-{{ $user->role->color() }}-100 px-2.5 py-1 text-xs font-medium text-{{ $user->role->color() }}-700">{{$user->role->label()}}</p>
                </div>
                <div>
                    <p class="text-slate-500">Status</p>
                    <p><span class="inline-flex rounded-full bg-{{ $user->status->color() }}-100 px-2.5 py-1 text-xs font-medium text-{{ $user->status->color() }}-700">{{$user->status->label()}}</span></p>
                </div>
            </div>
        </section>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }} flex flex-wrap gap-3">
                <a href="{{route('users.edit', $user)}}" class="{{ $ui['btnSecondary'] }}">Editar dados</a>
                <form action="{{route('users.status', $user)}}" method="POST">
                    @csrf
                    @method('PUT')

                    @if($user->status->value == 'ativo')
                        <button type="submit" class="{{ $ui['btnWarning'] }}">Desativar usuário</button>
                    @else
                        <button type="submit" class="{{ $ui['btnWarning'] }}">Ativar usuário</button>
                    @endif
                </form>
                <a href="{{route('users.deleteConfirmation', $user)}}" class="{{ $ui['btnDanger'] }}">Excluir permanentemente</a>
            </div>
        </section>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardHeader'] }}">
                <h2 class="text-lg font-semibold text-slate-900">Definir senha temporária</h2>
                <p class="text-sm text-slate-500 mt-1">Gere uma nova senha para reenvio de primeiro acesso.</p>
            </div>
            @can('user_is_admin')
                <div class="{{ $ui['cardBody'] }}">
                    <form action="{{route('users.changePassword', $user)}}" method="POST" class="grid md:grid-cols-[1fr_auto] gap-3 items-end">
                        @csrf
                        <div>
                            <label class="{{ $ui['label'] }}" for="senha_temporaria">Nova senha temporária</label>
                            <input id="senha_temporaria" name="senha_temporaria" type="text" class="{{ $ui['input'] }}" placeholder="Ex.: Temp@1234" />

                        </div>

                        <button type="submit" class="{{ $ui['btnSecondary'] }}">
                            Definir senha temporária
                        </button>
                    </form>
                    @error('senha_temporaria')
                    <span class="{{$ui['errorText']}}">{{$message}}</span>
                    @enderror
                </div>
            @endcan
        </section>
    </div>
</x-layouts.main-layout>
