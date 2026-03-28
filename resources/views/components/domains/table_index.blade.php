<?php

use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Domain;
use App\Models\Client;
use App\Models\Registrar;

new class extends Component {

    use WithPagination;

    public $search = '';
    public $clientId = '';
    public $registrarId = '';
    public $registrarAccountId = '';
    public $status = '';
    public $expiresUntil = '';
    public $filter = 'all';

    public $from = null;

    protected $paginationTheme = 'tailwind';


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
                $this->expiresUntil  = now()->addDays(15)->toDateString();

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
            ->whereHas('client', fn($q) => $q->whereNull('deleted_at'));

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

        $domains = $query->orderBy('expires_at')->paginate(10);
        $clients = Client::orderBy('name')->get();
        $registrars = Registrar::orderBy('name')->get();

        return view('components.domains.table_index', compact('domains', 'clients', 'registrars'));
    }



};


?>

<div>
    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="flex flex-wrap gap-2">
                <button wire:click="filtrar('all')" class="{{ $filter === 'all' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">Todos</button>
                <button wire:click="filtrar('within_deadline')" class="{{ $filter === 'within_deadline' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">Dentro do prazo</button>
                <button wire:click="filtrar('expires_soon')" class="{{ $filter === 'expires_soon' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">Expira em breve</button>
                <button wire:click="filtrar('expired')" class="{{ $filter === 'expired' ? $ui['filterBtnActive'] : $ui['filterBtn'] }}" type="button">Expirados</button>
                <div wire:loading >Carregando...</div>

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
                        <option value="1">Cliente A</option>
                        <option value="2">Cliente B</option>
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
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                        <option value="bloqueado">Bloqueado</option>
                        <option value="expirado">Expirado</option>
                    </select>
                </div>

                <div class="">
                    <label for="registrador_filtro" class="{{ $ui['label'] }}">Registrador</label>
                    <select wire:model.live="registrarId" id="registrador_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todas</option>
                        <option value="1">Godaddy</option>
                        <option value="2">NameCheap</option>
                        <option value="3">Registro.br</option>
                    </select>

                </div>

                <div class="">
                    <label for="conta_registrador_filtro" class="{{ $ui['label'] }}">Conta de registrador</label>
                    <select wire:model.live="registrarAccountId" id="conta_registrador_filtro"
                            class="{{ $ui['input'] }}">
                        <option value="">Todas</option>
                        <option value="1">RegistroBR - Principal</option>
                        <option value="2">Cloudflare - Time Infra</option>
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
                        <span class=" text-xs font-medium text-{{$domain->status->color()}}-600">{{$domain->status->label()}}</span>
                    </td>
                    <td class="{{ $ui['td'] }}">
                        <div class="flex flex-wrap gap-3">
                            <a class="text-slate-700 hover:text-slate-500" href="{{ route('domains.show', $domain) }}" title="Ver detalhes"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path d="M6 7.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                                    <path fill-rule="evenodd" d="M4 2a1.5 1.5 0 0 0-1.5 1.5v9A1.5 1.5 0 0 0 4 14h8a1.5 1.5 0 0 0 1.5-1.5V6.621a1.5 1.5 0 0 0-.44-1.06L9.94 2.439A1.5 1.5 0 0 0 8.878 2H4Zm3.5 2.5a3 3 0 1 0 1.524 5.585l1.196 1.195a.75.75 0 1 0 1.06-1.06l-1.195-1.196A3 3 0 0 0 7.5 4.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a class="text-slate-700 hover:text-slate-500" href="{{ route('domains.edit', $domain) }}"  title="Editar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                    <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                </svg>
                            </a>
                            @can('user_is_admin')
                            <a class="text-red-700 hover:text-red-500"
                               href="{{ route('domains.deleteConfirmation', $domain) }}"  title="Deletar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                </svg>
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
