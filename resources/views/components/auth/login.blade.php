<x-layouts.main-layout title="Login" >


    <section class="w-full max-w-md {{ $ui['card'] }}">
        <div class="{{ $ui['cardHeader'] }}">
            <h1 class="{{ $ui['title'] }}">Acessar sistema</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Faça login para gerenciar domínios e acompanhar vencimentos.</p>
        </div>

        <div class="{{ $ui['cardBody'] }}">
            <form class="space-y-4" action="{{route('authenticate')}}" method="POST">
                @csrf
                <div>
                    <label class="{{ $ui['label'] }}" for="email">Email</label>
                    <input id="email" name="email" type="email" class="{{ $ui['input'] }}" placeholder="admin@empresa.com" required value="{{old('email')}}"/>
                </div>

                <div>
                    <label class="{{ $ui['label'] }}" for="password">Senha</label>
                    <input id="password" name="password" type="password" class="{{ $ui['input'] }}" placeholder="********" required />
                </div>

                <div class="text-right">
                    <a href="{{route('forgot-password')}}" class="text-sm text-slate-600 hover:text-slate-900">Esqueci a senha</a>
                </div>

                <button type="submit" class="{{ $ui['btnPrimary'] }} w-full">
                    Entrar
                </button>
            </form>
        </div>
    </section>
</x-layouts.main-layout>
