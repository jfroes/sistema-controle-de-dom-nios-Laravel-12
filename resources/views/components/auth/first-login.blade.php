<x-layouts.main-layout title="Primeiro Login">


    <section class="w-full max-w-md {{ $ui['card'] }} place-self-center">
        <div class="{{ $ui['cardHeader'] }}">
            <h1 class="{{ $ui['title'] }}">Primeiro acesso</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Defina sua nova senha para continuar.</p>
        </div>

        <div class="{{ $ui['cardBody'] }}">
            <form class="space-y-4" action="{{route('password.change')}}" method="post">
                @csrf
                <div>
                    <label class="{{ $ui['label'] }}" for="email">Email</label>
                    <input id="email" name="email" type="email" class="{{ $ui['input'] }} bg-slate-100 text-slate-700" value="{{Auth::user()->email}}" readonly />
                </div>

                <div>
                    <label class="{{ $ui['label'] }}" for="senha_nova">Nova senha</label>
                    <input id="senha_nova" name="senha_nova" type="password" class="{{ $ui['input'] }}" placeholder="********"  />
                    @error('senha_nova')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                    @enderror
                </div>

                <div>
                    <label class="{{ $ui['label'] }}" for="senha_nova_confirmation">Confirmar nova senha</label>
                    <input id="senha_nova_confirmation" name="senha_nova_confirmation" type="password" class="{{ $ui['input'] }}" placeholder="********"  />
                    @error('senha_nova_confirmation')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                    @enderror
                </div>

                <button type="submit" class="{{ $ui['btnPrimary'] }} w-full">
                    Definir nova senha
                </button>
            </form>
        </div>
    </section>
</x-layouts.main-layout>
