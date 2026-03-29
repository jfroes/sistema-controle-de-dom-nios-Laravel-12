<x-layouts.main-layout title="Dashboard | Domínios">


    <div class="space-y-6">
        <header class="flex justify-between items-center">
            <div>
                <h1 class="{{ $ui['title'] }}">Dashboard</h1>
                <p class="{{ $ui['subtitle'] }} mt-1">Visão geral dos domínios e alertas de expiração.</p>
            </div>

            <div>
                <h1 class="text-lg text-gray-500">Olá, {{Auth::user()->full_name}}</h1>
            </div>
        </header>

        <section class="grid md:grid-cols-3 gap-4">
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-sm text-slate-500">Total de domínios</p>
                    @if($domains->count() > 0)
                        <p class="text-3xl font-semibold text-slate-900 mt-2">{{$domains->count()}}</p>
                    @else
                        <p class="text-sm font-light text-slate-900 mt-2 italic">Nenhum domínio cadastrado</p>
                    @endif
                </div>
            </article>
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-sm text-slate-500">Expiram em até 30 dias</p>
                    <p class="text-3xl font-semibold text-amber-600 mt-2">{{$expiresIn30days->count()}}</p>
                </div>
            </article>
            <article class="{{ $ui['card'] }}">
                <div class="{{ $ui['cardBody'] }}">
                    <p class="text-sm text-slate-500">Expirados</p>
                    <p class="text-3xl font-semibold text-red-600 mt-2 flex gap-4 items-center"><x-lucide-alert-circle class="w-8 "/>{{$expired->count()}}</p>
                </div>
            </article>
        </section>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardHeader'] }}">
                <h2 class="text-lg font-semibold text-slate-900">Expirados</h2>
            </div>
            <div class="{{ $ui['cardBody'] }}">
                <div class="{{ $ui['tableWrap'] }}">
                    <table class="{{ $ui['table'] }}">
                        <thead>
                        <tr>
                            <th class="{{ $ui['th'] }}">Domínio</th>
                            <th class="{{ $ui['th'] }}">Cliente</th>
                            <th class="{{ $ui['th'] }}">Expiração</th>
                            <th class="{{ $ui['th'] }}">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expired as $domain)
                            <tr>
                                <td class="{{ $ui['td'] }}">{{$domain->name}}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->client->name }}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->expires_at->format('d/m/Y') }}</td>
                                <td class="{{ $ui['td'] }}"><span class="{{ $ui['badgeDanger'] }}">Expirado</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </section>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardHeader'] }}">
                <h2 class="text-lg font-semibold text-slate-900">Próximos vencimentos</h2>
            </div>
            <div class="{{ $ui['cardBody'] }}">
                <div class="{{ $ui['tableWrap'] }}">
                    <table class="{{ $ui['table'] }}">
                        <thead>
                        <tr>
                            <th class="{{ $ui['th'] }}">Domínio</th>
                            <th class="{{ $ui['th'] }}">Cliente</th>
                            <th class="{{ $ui['th'] }}">Expiração</th>
                            <th class="{{ $ui['th'] }}">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expiresIn30days as $domain)
                            <tr>
                                <td class="{{ $ui['td'] }}">{{$domain->name}}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->client->name }}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->expires_at->format('d/m/Y') }}</td>
                                <td class="{{ $ui['td'] }}"><span class="{{ $ui['badgeWarning'] }}">Vence em breve</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
