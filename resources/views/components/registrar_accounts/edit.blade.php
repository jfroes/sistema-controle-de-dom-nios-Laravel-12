<x-layouts.main-layout title="Editar Conta de Domínio">
    <div class="space-y-6 max-w-4xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Editar conta de registrador</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Atualize os dados da conta utilizada para os domínios.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('registrar_accounts.update', $registrar_account)}}" method="POST" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="{{ $ui['label'] }}" for="registrador_id">Registrador</label>
                        <select id="registrador_id" name="registrador_id" class="{{ $ui['input'] }}" required>
                            @foreach($registrars as $registrar)
                                <option value="{{$registrar->id}}" {{ old('registrador_id', $registrar->id ?? '') == $registrar_account->registrar_id ? 'selected' : '' }}>{{$registrar->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="label">Label</label>
                        <input id="label" name="label" type="text" class="{{ $ui['input'] }}" value="{{$registrar_account->label}}" required />
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $ui['label'] }}" for="username">Username</label>
                        <input id="username" name="username" type="text" class="{{ $ui['input'] }}" value="{{ $registrar_account->username ?? '' }}" required />
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $ui['label'] }}" for="notas">Notas (opcional)</label>
                        <textarea id="notas" name="notas" class="{{ $ui['textarea'] }}">{{$registrar_account->notes ?? ''}}</textarea>
                    </div>

                    <div class="md:col-span-2 flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar alterações</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
