<?php

use App\Models\Domain;
use App\Models\Registrar;
use App\Models\RegistrarAccount;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $conta_filtro = '';
    public Registrar $registrar;


    protected $paginationTheme = 'tailwind';

    public function mount(Registrar $registrar)
    {
        $this->registrar->loadMissing('domains.client');
    }


    public function updated($property)
    {
        if (in_array($property, ['search', 'conta_filtro'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Domain::query()
            ->whereIn('registrar_account_id', $this->registrar->accounts->pluck('id'))
            ->whereNull('deleted_at')
            ->whereHas('client', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('client', function ($q2) {
                        $q2->whereNull('deleted_at')      // garante aqui também
                        ->where('name', 'like', '%' . $this->search . '%');
                    });
            });

        if ($this->conta_filtro) {
            $query->where('registrar_account_id', $this->conta_filtro);
        }

        $domains = $query->paginate(8);
        $accounts = RegistrarAccount::all();

        return view('components.registrars.⚡table_show', compact('domains', 'accounts'));
    }


};
?>

<div class="space-y-4">


    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardHeader'] }}">
            <h2 class="text-lg font-semibold text-slate-900">Sites relacionados ao registrador</h2>
            <p class="text-sm text-slate-500 mt-1">Lista de domínios vinculados por conta de registrador.</p>
        </div>
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="{{ $ui['label'] }} flex items-center gap-2" for="search_dominios">Pesquisar domínio
                        <div wire:loading>
                            <x-lucide-refresh-cw class="{{$ui['icon-size']}} animate-spin"/>
                        </div>
                    </label>
                    <input wire:model.live="search" id="search_dominios" type="search" class="{{ $ui['input'] }}"
                           placeholder="Buscar por domínio ou cliente"/>
                </div>
                <div>
                    <label class="{{ $ui['label'] }}" for="conta_filtro">Conta de registrador</label>
                    <select wire:model.live="conta_filtro" id="conta_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todas</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="{{ $ui['tableWrap'] }}">
                <table class="{{ $ui['table'] }}">
                    <thead>
                    <tr>
                        <th class="{{ $ui['th'] }}">Domínio</th>
                        <th class="{{ $ui['th'] }}">Cliente</th>
                        <th class="{{ $ui['th'] }}">Conta</th>
                        <th class="{{ $ui['th'] }}">Expiração</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($domains->count() > 0)
                        @foreach($domains as $domain)
                            <tr>
                                <td class="{{ $ui['td'] }}">{{$domain->name}}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->client->name ?? '-' }}</td>
                                <td class="{{ $ui['td'] }}">{{$domain->registrarAccount->label ?? '-'}}</td>
                                <td class="{{ $ui['td'] }}">15/05/2026</td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="4" class="{{ $ui['td'] }} text-center py-6">
                                Nenhum domínio encontrado para essa conta de registrador.
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div>
        {{ $domains->links() }}
    </div>

</div>
