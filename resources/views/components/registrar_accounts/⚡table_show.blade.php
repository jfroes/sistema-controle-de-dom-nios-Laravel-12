<?php

use App\Enums\DomainStatusEnum;
use App\Models\Registrar;
use App\Models\RegistrarAccount;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $status_filtro = '';
    public $statuses = [];
    public $account;


    protected $paginationTheme = 'tailwind';

    public function mount(RegistrarAccount $registrar_account)
    {
        $this->account = $registrar_account;
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
        $query = RegistrarAccount::query()->find($this->account->id)
            ->domains()
            ->with('client')
            ->whereHas('client', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('client', function ($q2) {
                            $q2->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->status_filtro, function ($query) {
                $query->where('status', $this->status_filtro);
            });

            if ($this->status_filtro) {
                $query->where('status', $this->status_filtro);
            }


        $domains = $query->paginate(5);
//        $registrars = Registrar::all();

        $statuses = $this->statuses;

        return view('components.registrar_accounts.⚡table_show', compact('domains', 'statuses'));
    }


};
?>

<div>
    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardHeader'] }}">
            <h2 class="text-lg font-semibold text-slate-900">Domínios vinculados</h2>
        </div>
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="{{ $ui['label'] }}" for="search">Pesquisar domínio</label>
                    <input wire:model.live="search" id="search" type="search" class="{{ $ui['input'] }}"
                           placeholder="Buscar domínio ou cliente"/>
                </div>
                <div>
                    <label class="{{ $ui['label'] }}" for="status_filtro">Status</label>
                    <select wire:model.live="status_filtro" id="status_filtro" class="{{ $ui['input'] }}">
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
                        <th class="{{ $ui['th'] }}">Cliente</th>
                        <th class="{{ $ui['th'] }}">Expiração</th>
                        <th class="{{ $ui['th'] }}">Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($domains as $domain)                    <tr>
                        <td class="{{ $ui['td'] }}">{{$domain->name}}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->client->name ?? '-'}}</td>
                        <td class="{{ $ui['td'] }}">{{$domain->expires_at->format('d/m/Y')}}</td>
                        <td class="{{ $ui['td'] }}"><span class="inline-flex rounded-full bg-{{$domain->status->color()}}-100 px-2.5 py-1 text-xs font-medium text-{{$domain->status->color()}}-700">{{$domain->status->label()}}</span></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="{{ $ui['td'] }} text-center py-6">
                                Nenhum domínio encontrado.
                            </td>
                        </tr>
                    @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{ $domains->links() }}
</div>
