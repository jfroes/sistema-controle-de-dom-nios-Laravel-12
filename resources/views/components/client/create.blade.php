<x-layouts.main-layout title="Novo cliente">
    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Novo cliente</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Cadastre um novo cliente para vincular aos domínios.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('clients.store')}}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="{{ $ui['label'] }}" for="nome">Nome do cliente</label>
                        <input id="nome" name="nome" type="text" class="{{ $ui['input'] }}"  />
                        @error('nome')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar cliente</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
