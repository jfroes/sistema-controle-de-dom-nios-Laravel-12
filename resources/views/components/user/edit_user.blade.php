<x-layouts.main-layout title="Editar Usuário">


    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Editar dados do usuário</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Atualize as informações de acesso e perfil deste usuário.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('users.update', $user)}}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="{{ $ui['label'] }}" for="nome">Nome completo</label>
                        <input id="nome" name="nome" type="text" class="{{ $ui['input'] }}" value="{{$user->full_name ?? old('nome')}}" required />
                        @error('nome')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="email">Email</label>
                        <input id="email" name="email" type="email" class="{{ $ui['input'] }}" value="{{$user->email ?? old('nome')}}" required />
                        @error('email')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    @can('user_is_admin')
                    <div>
                        <label class="{{ $ui['label'] }}" for="perfil">Perfil</label>
                        <select id="perfil" name="perfil" class="{{ $ui['input'] }}" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->value }}"
                                    {{ old('perfil', $user->role->value ?? '') == $role->value ? 'selected' : '' }}>

                                    {{ $role->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('perfil')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>
                    @endcan
                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar alterações</button>
                        <a href="{{Gate::allows('user_is_admin') ? url()->previous() : route('users.show', Auth::user())}}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
