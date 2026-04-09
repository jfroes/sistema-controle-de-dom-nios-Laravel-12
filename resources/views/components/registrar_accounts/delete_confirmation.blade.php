<x-layouts.main-layout title="Deletar Conta de Registrador">
    <div class="space-y-6 max-w-3xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Excluir conta de registrador</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Confirme a exclusão da conta selecionada.</p>
        </header>

        <section class="{{ $ui['card'] }} border-red-200">
            <div class="{{ $ui['cardBody'] }} space-y-4">
                <p class="text-sm text-slate-700">Você está prestes a excluir a conta <strong>{{$registrar_account->label}}</strong> do registrador <strong>{{$registrar_account->registrar->name}}</strong>.</p>
                <p class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">Atenção: domínios vinculados precisarão ser associados a outra conta antes da exclusão.</p>

                <form action="{{route('registrar_accounts.destroy', $registrar_account)}}" method="POST" class="grid md:grid-cols-1 gap-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="confirmation_text"></label>
                        <input type="text" id="confirmation_text" name="confirmation_text" class="{{ $ui['input'] }} flex-1" placeholder="Digite o nome da conta de registrador para confirmar"  />

                        @error('confirmation_text')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="{{ $ui['btnDanger'] }}">Confirmar deleção</button>
                        <a href="{{ url()->previous() }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>

            </p>

        </section>
    </div>
</x-layouts.main-layout>
