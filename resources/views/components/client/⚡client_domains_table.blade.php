<?php

use App\Enums\DomainStatusEnum;
use App\Models\Client;
use App\Models\Domain;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $domain_filtro = '';
    public $filter = 'all';
    public $statuses = [];
    public Client $client;


    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->statuses = collect(DomainStatusEnum::cases())->mapWithKeys(fn($status) => [$status->value => $status->label()])->toArray();
    }


    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Domain::query()->whereNull('deleted_at')->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')->where('client_id', $this->client->id);
        });

        if ($this->domain_filtro === 'ativo') {
            $query->where('status', DomainStatusEnum::ACTIVE->value);
        }

        if ($this->domain_filtro === 'inativo') {
            $query->where('status', DomainStatusEnum::INACTIVE->value);
        }

        if ($this->domain_filtro === 'expirado') {
            $query->where('status', DomainStatusEnum::EXPIRED->value);
        }

        if ($this->domain_filtro === 'bloqueado') {
            $query->where('status', DomainStatusEnum::BLOCKED->value);
        }

        $domains = $query->paginate(10);

        return view('components.client.⚡client_domains_table', [
            'domains' => $domains,
            'statuses' => $this->statuses,
        ]);
    }


};
?>

<div>
    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardHeader'] }}">
            <h2 class="text-lg font-semibold text-slate-900">Domínios do cliente</h2>
        </div>
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="{{ $ui['label'] }}" for="search">Pesquisar domínio</label>
                    <input wire:model.live="search" id="search" type="search" class="{{ $ui['input'] }}"
                           placeholder="Buscar domínio"/>
                </div>
                <div>
                    <label class="{{ $ui['label'] }}" for="status_filtro">Status</label>
                    <select wire:model.live="domain_filtro" id="status_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        @foreach($statuses as $value => $label)
                            <option value="{{$value}}">{{$label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="{{ $ui['tableWrap'] }}">
                <table class="{{ $ui['table'] }}">
                    <thead>
                    <tr>
                        <th class="{{ $ui['th'] }}">Domínio</th>
                        <th class="{{ $ui['th'] }}">Conta de registrador</th>
                        <th class="{{ $ui['th'] }}">Expiração</th>
                        <th class="{{ $ui['th'] }}">Status</th>
                        <th class="{{ $ui['th'] }}">Situação</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if($domains->count() > 0)
                        @foreach($domains as $domain)
                            <tr>
                                <td class="{{ $ui['td'] }}"><a href="{{route('domains.show', $domain)}}" class="underline underline-offset-2 text-blue-600 hover:text-blue-500">{{$domain->name}}</a></td>
                                <td class="{{ $ui['td'] }}">{{$domain->registrarAccount->label}}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->expires_at->format('d/m/Y')}}</td>
                                @php
                                    $dataFim = Carbon::parse($domain->expires_at->startOfDay());
                                    $diferenca = Carbon::now()->startOfDay()->diffInDays($dataFim, false);
                                @endphp

                                <td class="{{ $ui['td'] }}">
                                    @if($diferenca > 0 && $diferenca <= 15)
                                        <span class="{{$ui['badgeWarning']}}">Expira em {{$diferenca}} dias</span>
                                    @elseif($diferenca < 0)
                                        <span class="{{$ui['badgeDanger']}}">Expirado há {{abs($diferenca)}} dias</span>
                                    @else
                                        <span class="{{$ui['badgeOk']}}">Dentro do prazo</span>
                                    @endif
                                </td>

                                <td class="{{ $ui['td'] }}">
                                    <span class=" text-xs font-medium text-{{$domain->status->color()}}-600">{{$domain->status->label()}}</span>
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="{{ $ui['td'] }} text-center text-slate-500">Nenhum domínio encontrado
                                para este cliente.
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- Paginação --}}
    <div class="mt-4">
        {{ $domains->links() }}
    </div>
</div>
