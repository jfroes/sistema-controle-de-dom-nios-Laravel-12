<x-layouts.main-layout title="Esqueci a Senha">
    @aware(['ui'])
    <section class="w-full max-w-md {{ $ui['card'] }}">
        <div class="{{ $ui['cardHeader'] }}">
            <h1 class="{{ $ui['title'] }}">Esqueci minha senha</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Informe seu email para receber o link de redefinição.</p>
        </div>

        <div class="{{ $ui['cardBody'] }}">
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-4" action="{{ route('send-reset-email') }}" method="POST">
                @csrf

                <div>
                    <label class="{{ $ui['label'] }}" for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="{{ $ui['input'] }}"
                        placeholder="usuario@empresa.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="{{ $ui['btnPrimary'] }} w-full">
                    Enviar link de redefinição
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-900">Voltar para login</a>
            </div>
        </div>
    </section>
</x-layouts.main-layout>
