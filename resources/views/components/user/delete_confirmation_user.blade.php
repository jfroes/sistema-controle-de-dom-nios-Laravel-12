<x-layouts.main-layout title="Confirmar Exclusão">

    <div class="max-w-2xl">
        <section class="{{ $ui['card'] }} border-red-200">
            <div class="{{ $ui['cardHeader'] }}">
                <h1 class="{{ $ui['title'] }} text-red-700">Confirmar exclusão permanente</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Essa ação remove o usuário e não poderá ser desfeita.</p>
            </div>
            <div class="{{ $ui['cardBody'] }} space-y-5">
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    Você está prestes a excluir permanentemente o usuário <strong>{{$user->full_name}}</strong>.
                    <div>email: <strong>{{$user->email}}</strong></div>
                </div>

                <form action="{{route('users.destroy', $user)}}" method="POST" class="flex flex-wrap gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="{{ $ui['btnDanger'] }}">Confirmar exclusão</button>
                    <a href="{{url()->previous()}}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
