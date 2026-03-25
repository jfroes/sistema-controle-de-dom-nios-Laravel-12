<x-layouts.main-layout title="Cadastro de Usuário">
    @aware(['ui'])

    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Cadastro de usuário</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Crie um novo usuário para acesso administrativo ao sistema.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{{route('users.store')}}}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="{{ $ui['label'] }}" for="name">Nome completo</label>
                        <input id="name" name="name" type="text" class="{{ $ui['input'] }}"  value="{{old('name')}}"  />
                        @error('name')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="email">Email</label>
                        <input id="email" name="email" type="email" class="{{ $ui['input'] }}" value="{{old('email')}}"  />
                        @error('email')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="senha_temporaria">Senha temporária</label>
                        <input id="senha_temporaria" name="senha_temporaria" type="text" class="{{ $ui['input'] }}"   />
                        @error('senha_temporaria')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="perfil">Perfil</label>
                        <select id="perfil" name="perfil" class="{{ $ui['input'] }}" required>
                            @foreach($roles as $role)
                                <option value="{{$role->value}}">{{$role->label()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="{{ $ui['btnPrimary'] }}">Cadastrar usuário</button>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
