<x-layouts.main-layout title="Editar Cliente">
    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Editar cliente</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Atualize o nome do cliente.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form action="{{route('clients.update', $client)}}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="{{ $ui['label'] }}" for="nome">Nome do cliente</label>
                        <input id="nome" name="nome" type="text" class="{{ $ui['input'] }}" value="{{$client->name}}" required />
                        @error('nome')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar alterações</button>
                        <a href="{{ route('clients.index') }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
