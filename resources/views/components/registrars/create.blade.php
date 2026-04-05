<x-layouts.main-layout title="Cadastrar Novo Registrador">
    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Novo registrador</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Cadastre nome e website do registrador.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('registrars.store')}}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="{{ $ui['label'] }}" for="nome">Nome*</label>
                        <input id="nome" name="nome" type="text" class="{{ $ui['input'] }}"  value="{{old('nome')}}"/>
                        @error('nome')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="website">Website</label>
                        <input id="website" name="website" type="url" class="{{ $ui['input'] }}" placeholder="https://registrador.com" value="{{old('website')}}" />
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar registrador</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
