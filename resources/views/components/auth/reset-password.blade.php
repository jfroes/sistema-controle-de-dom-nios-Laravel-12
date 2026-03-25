<x-layouts.main-layout title="Reset de Senha">
    @aware(['ui'])

    <section class="w-full max-w-md {{ $ui['card'] }} place-self-center">
        <div class="{{ $ui['cardHeader'] }}">
            <h1 class="{{ $ui['title'] }}">Definir Nova Senha</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Defina sua nova senha para continuar.</p>
        </div>

        <div class="{{ $ui['cardBody'] }}">
            <form class="space-y-4" action="{{route('update-password')}}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{$token}}">

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

                <a href="{{route('login')}}" class="text-xs mt-4 inline-block underline decoration-solid underline-offset-2">Não quero redefinir a senha</a>
            </form>
        </div>
    </section>
</x-layouts.main-layout>
