<x-layouts.main-layout title="Confirmar Exclusão">

    <div class="max-w-2xl">
        <section class="{{ $ui['card'] }} border-red-200">
            <div class="{{ $ui['cardHeader'] }}">
                <h1 class="{{ $ui['title'] }} text-red-700">Confirme a exclusão do registrador e de seus vínculos.</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Essa ação remove o registrador e não poderá ser desfeita.</p>
            </div>
            <div class="{{ $ui['cardBody'] }} space-y-5">
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    Você está prestes a excluir permanentemente o registrador <strong>{{$registrar->name}}</strong>.
                </div>

                <form action="{{route('registrars.destroy', $registrar)}}" method="POST" class="grid md:grid-cols-1 gap-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="confirmation_text"></label>
                        <input type="text" id="confirmation_text" name="confirmation_text" class="{{ $ui['input'] }} flex-1" placeholder="Digite o nome do registrador para confirmar"  />

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
