<?php

use App\Enums\DomainStatusEnum;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Domain;
use App\Models\Client;
use App\Models\Registrar;
use App\Models\RegistrarAccount;

new class extends Component {

    use WithPagination;

    public $search = '';
    public $clientId = '';
    public $registrarId = '';
    public $registrarAccountId = '';
    public $status = '';
    public $expiresUntil = '';
    public $filter = 'all';
    public $statuses = [];


    public $from = null;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->statuses = collect(DomainStatusEnum::cases())->mapWithKeys(fn($status) => [$status->value => $status->label()])->toArray();
    }


    public function updated($property)
    {
        if (in_array($property, ['search', 'clientId', 'registrarId', 'status'])) {
            $this->resetPage();
        }
    }

    public function filtrar($filter)
    {
        $this->filter = $filter;


        switch ($filter) {
            case 'expires_soon':
                $this->from = now()->toDateString();
                $this->expiresUntil = now()->addDays(15)->toDateString();

                break;
            case 'expired':
                $this->from = null;
                $this->expiresUntil = now()->subDay()->toDateString();
                break;
            case 'within_deadline':
                $this->from = now()->startOfDay();
                $this->expiresUntil = null;
                break;

            default:
                $this->from = null;
                $this->expiresUntil = null;

        }
    }

    public function render()
    {
        $query = Domain::query()
            ->with(['client', 'registrarAccount.registrar'])
            ->whereHas('client', fn($q) => $q->whereNull('deleted_at'))
            ->whereHas('registrarAccount.registrar', fn($q) => $q->whereNull('deleted_at'));

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('client', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('registrarAccount.registrar', function ($q) {
                    ;
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        if ($this->clientId) {
            $query->where('client_id', $this->clientId);
        }

        if ($this->registrarId) {
            $query->whereHas('registrarAccount.registrar', function ($q) {
                $q->where('id', $this->registrarId);
            });
        }

        if ($this->registrarAccountId) {
            $query->whereHas('registrarAccount', function ($q) {
                $q->where('id', $this->registrarAccountId);
            });
        }

        if ($this->from && $this->expiresUntil) {
            $query->whereBetween('expires_at', [
                $this->from,
                $this->expiresUntil
            ]);
        } elseif ($this->from) {
            $query->where('expires_at', '>=', $this->from);
        } elseif ($this->expiresUntil) {
            $query->where('expires_at', '<=', $this->expiresUntil);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $domains = $query->orderBy('expires_at')->paginate(8);
        $clients = Client::orderBy('name')->get();
        $registrars = Registrar::orderBy('name')->get();
        $registrarAccounts = RegistrarAccount::all();

        $statuses = $this->statuses;

        return view('components.domains.table_index', compact('domains', 'clients', 'registrars', 'registrarAccounts', 'statuses' ));
    }


};


?>

<div class=" space-y-6">
    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="flex flex-wrap gap-2">
                <button wire:click="filtrar('all')"
                        class="{{ $filter === 'all' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">Todos
                </button>
                <button wire:click="filtrar('within_deadline')"
                        class="{{ $filter === 'within_deadline' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}"
                        type="button">Dentro do prazo
                </button>
                <button wire:click="filtrar('expires_soon')"
                        class="{{ $filter === 'expires_soon' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}"
                        type="button">Expira em breve
                </button>
                <button wire:click="filtrar('expired')"
                        class="{{ $filter === 'expired' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">
                    Expirados
                </button>
                <div wire:loading><x-lucide-refresh-cw class="{{$ui['icon-size']}} animate-spin"/></div>

            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="{{ $ui['label'] }}">Pesquisar</label>
                    <input
                        wire:model.live="search"
                        id="search"
                        type="search"
                        class="{{ $ui['input'] }}"
                        placeholder="Buscar por domínio ou cliente"
                    />
                </div>

                <div>
                    <label for="cliente_filtro" class="{{ $ui['label'] }}">Cliente</label>
                    <select wire:model.live="clientId" id="cliente_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="expiracao_ate" class="{{ $ui['label'] }}">Expiração até</label>
                    <input wire:model.live="expiresUntil" id="expiracao_ate" type="date" class="{{ $ui['input'] }}"/>
                </div>

                <div>
                    <label for="status_filtro" class="{{ $ui['label'] }}">Status</label>
                    <select wire:model.live="status" id="status_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        @foreach($statuses as $value => $label)
                            <option value="{{$value}}">{{$label}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <label for="registrador_filtro" class="{{ $ui['label'] }}">Registrador</label>
                    <select wire:model.live="registrarId" id="registrador_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        @foreach($registrars as $registrar)
                            <option value="{{$registrar->id}}">{{$registrar->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="">
                    <label for="conta_registrador_filtro" class="{{ $ui['label'] }}">Conta de registrador</label>
                    <select wire:model.live="registrarAccountId" id="conta_registrador_filtro"
                            class="{{ $ui['input'] }}">
                        <option value="">Todas</option>
                        @foreach($registrarAccounts as $account)
                            <option value="{{$account->id}}">{{$account->label}} ({{$account->registrar->name}})
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
    </section>

    <section class="{{ $ui['tableWrap'] }}">
        <table class="{{ $ui['table'] }}">
            <thead>
            <tr>
                <th class="{{ $ui['th'] }}">Domínio</th>
                <th class="{{ $ui['th'] }}">Cliente</th>
                <th class="{{ $ui['th'] }}">Registrador</th>
                <th class="{{ $ui['th'] }}">Conta de registrador</th>
                <th class="{{ $ui['th'] }}">Expiração</th>
                <th class="{{ $ui['th'] }}">Status</th>
                <th class="{{ $ui['th'] }}">Situação</th>
                <th class="{{ $ui['th'] }}">Ações</th>
            </tr>
            </thead>
            <tbody>

            @if($domains->count() > 0)
                @foreach($domains as $domain)
                    <tr>
                        <td class="{{ $ui['td'] }}">{{$domain->name}}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->client->name }}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->registrarAccount->registrar->name}}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->registrarAccount->label}}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->expires_at->format('d/m/Y') }}</td>

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
                            <span
                                class=" text-xs font-medium text-{{$domain->status->color()}}-600">{{$domain->status->label()}}</span>
                        </td>
                        <td class="{{ $ui['td'] }}">
                            <div class="flex flex-wrap gap-3">
                                <a class="text-slate-700 hover:text-slate-500"
                                   href="{{ route('domains.show', $domain) }}" title="Ver detalhes">
                                    <x-lucide-file-search-corner class="{{ $ui['icon-size'] }} "/>

                                </a>
                                <a class="text-slate-700 hover:text-slate-500"
                                   href="{{ route('domains.edit', $domain) }}" title="Editar">
                                    <x-lucide-edit class="{{ $ui['icon-size'] }} "/>


                                </a>
                                @can('user_is_admin')
                                    <a class="text-red-700 hover:text-red-500"
                                       href="{{ route('domains.deleteConfirmation', $domain) }}" title="Deletar">
                                        <x-lucide-trash class="{{ $ui['icon-size'] }}  "/>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="{{ $ui['td'] }} text-center py-6">
                        Nenhum domínio encontrado.
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </section>

    <div>
        {{ $domains->links() }}
    </div>

</div>
