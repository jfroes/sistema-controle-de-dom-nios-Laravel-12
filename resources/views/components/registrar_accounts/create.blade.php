<x-layouts.main-layout title="Criar Conta de Registrador">
    <div class="space-y-6 max-w-4xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Nova conta de registrador</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Cadastre credenciais vinculando uma conta a um registrador existente.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('registrar_accounts.store')}}" method="POST" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="{{ $ui['label'] }}" for="registrador_id">Registrador</label>
                        <select id="registrador_id" name="registrador_id" class="{{ $ui['input'] }}" >
                            <option value="">Selecione</option>
                            @foreach($registrars as $registrar)
                                <option value="{{ $registrar->id }}">{{ $registrar->name }}</option>
                            @endforeach
                        </select>
                        @error('registrador_id')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror

                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="label">Label</label>
                        <input id="label" name="label" type="text" class="{{ $ui['input'] }}" placeholder="Principal"  value="{{old('label')}}"/>
                        @error('label')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $ui['label'] }}" for="username">Username</label>
                        <input id="username" name="username" type="text" class="{{ $ui['input'] }}" placeholder="usuario.registrador"  value="{{old('username')}}"/>
                        @error('username')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $ui['label'] }}" for="notas">Notas (opcional)</label>
                        <textarea id="notas" name="notas" class="{{ $ui['textarea'] }}" placeholder="Informações de uso interno da conta." >{{old('notas')}}</textarea>
                        @error('notas')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar conta</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
