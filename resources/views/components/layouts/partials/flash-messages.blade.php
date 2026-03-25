@session('success')
<div class="fixed bottom-4 right-4 z-50 w-[min(92vw,420px)]" id="flash-success-wrap">
    <div
        id="flash-success"
        class="flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3 shadow-lg"
    >
        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white text-xs font-bold">✓</span>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-semibold">Sucesso</p>
            <p class="text-sm leading-5 break-words">{{ $value }}</p>
        </div>
        <button
            type="button"
            class="ml-2 text-emerald-700/80 hover:text-emerald-900 text-lg leading-none"
            aria-label="Fechar mensagem de sucesso"
            onclick="document.getElementById('flash-success-wrap')?.remove()"
        >
            ×
        </button>
    </div>
</div>
@endsession

@session('error')
<div class="fixed bottom-4 right-4 z-50 w-[min(92vw,420px)]" id="flash-error-wrap">
    <div
        id="flash-error"
        class="flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3 shadow-lg"
    >
        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-600 text-white text-xs font-bold">!</span>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-semibold">Erro</p>
            <p class="text-sm leading-5 break-words">{{ $value }}</p>
        </div>
        <button
            type="button"
            class="ml-2 text-red-700/80 hover:text-red-900 text-lg leading-none"
            aria-label="Fechar mensagem de erro"
            onclick="document.getElementById('flash-error-wrap')?.remove()"
        >
            ×
        </button>
    </div>
</div>
@endsession

@session('warning')
<div class="fixed bottom-4 right-4 z-50 w-[min(92vw,420px)]" id="flash-warning-wrap">
    <div
        id="flash-warning"
        class="flex items-start gap-3 rounded-lg border-l-4 border-amber-400 border border-amber-200 bg-amber-50 text-amber-900 px-4 py-3 shadow-lg"
    >
        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-amber-400 text-amber-900 text-xs font-bold">!</span>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-semibold">Atenção</p>
            <p class="text-sm leading-5 break-words">{{ $value }}</p>
        </div>
        <button
            type="button"
            class="ml-2 text-amber-700/80 hover:text-amber-900 text-lg leading-none"
            aria-label="Fechar mensagem de alerta"
            onclick="document.getElementById('flash-warning-wrap')?.remove()"
        >
            ×
        </button>
    </div>
</div>
@endsession

<script>
    setTimeout(() => {
        ['flash-success-wrap', 'flash-error-wrap', 'flash-warning-wrap'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.remove();
        });
    }, 5000);
</script>
