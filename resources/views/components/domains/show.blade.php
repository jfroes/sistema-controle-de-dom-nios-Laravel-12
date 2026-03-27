<x-layouts.main-layout title="Detalhes do Domínio">

    <div class="space-y-6 max-w-5xl">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="{{ $ui['title'] }}">Domínio: {{$domain->name}}</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Detalhes operacionais e de renovação.</p>
            </div>
            <a href="{{ url('admin/dominios/1/edit') }}" class="{{ $ui['btnSecondary'] }}">Editar domínio</a>
        </header>

        <section class="grid md:grid-cols-2 gap-4">
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }} space-y-2">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Cliente</p>
                    <p class="text-sm text-slate-900">{{$domain->client->name}}</p>
                    <div class="flex justify-between space-y-2">
                        <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Registrador</p>
                        <p class="text-sm text-slate-900">{{$domain->registrarAccount->registrar->name}}</p>
                        </div>

                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Conta de registrador</p>
                            <p class="text-sm text-slate-900">{{$domain->registrarAccount->label}}</p>
                        </div>
                    </div>
                    <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Status</p>
                    <p><span class="inline-flex rounded-full bg-{{$domain->status->color()}}-100 px-2.5 py-1 text-xs font-medium text-{{$domain->status->color()}}-700">{{$domain->status}}</span></p>
                </div>
            </article>

            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }} space-y-2">
                    <p class="text-xs uppercase tracking-wide text-slate-500">Expiração</p>
                    <p class="text-sm text-slate-900">{{$domain->expires_at->format('d/m/Y')}}</p>

                    <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Host</p>
                    <p class="text-sm text-slate-900">{{$domain->host ?? 'Não cadastrado'}}</p>

                    <p class="text-xs uppercase tracking-wide text-slate-500 pt-2">Usuário host</p>
                    <p class="text-sm text-slate-900">{{$domain->host_user ?? 'Não cadastrado'}}</p>
                </div>
            </article>
        </section>
{{--TODO--}}
{{--        <section class="{{ $ui['card'] }}">--}}
{{--            <div class="{{ $ui['cardHeader'] }}">--}}
{{--                <h2 class="text-lg font-semibold text-slate-900">Histórico de eventos</h2>--}}
{{--            </div>--}}
{{--            <div class="{{ $ui['cardBody'] }}">--}}
{{--                <ul class="space-y-3 text-sm text-slate-700">--}}
{{--                    <li class="border-l-2 border-slate-200 pl-3">26/03/2026 - Status alterado para Em atenção.</li>--}}
{{--                    <li class="border-l-2 border-slate-200 pl-3">15/02/2026 - Conta de registrador atualizada para RegistroBR - Principal.</li>--}}
{{--                    <li class="border-l-2 border-slate-200 pl-3">10/01/2026 - Domínio cadastrado no sistema.</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>
</x-layouts.main-layout>
