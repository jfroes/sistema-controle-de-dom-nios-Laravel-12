<x-layouts.main-layout title="Confirmar Exclusão do Domínio">
    <div class="max-w-2xl">
        <section class="{{ $ui['card'] }} border-red-200">
            <div class="{{ $ui['cardHeader'] }}">
                <h1 class="{{ $ui['title'] }} text-red-700">Confirmar exclusão permanente</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Essa ação é irreversível e removerá o domínio do sistema.</p>
            </div>
            <div class="{{ $ui['cardBody'] }} space-y-5">
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    Você está prestes a deletar o domínio <strong>{{$domain->name}}</strong>. Essa operação não pode ser desfeita.
                </div>

                <form action="{{route('domains.destroy', $domain)}}" method="POST" class="grid md:grid-cols-1 gap-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="confirmation_text"></label>
                        <input type="text" id="confirmation_text" name="confirmation_text" class="{{ $ui['input'] }} flex-1" placeholder="Digite o nome do domínio para confirmar"  />

                        @error('confirmation_text')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="{{ $ui['btnDanger'] }}">Confirmar deleção</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
