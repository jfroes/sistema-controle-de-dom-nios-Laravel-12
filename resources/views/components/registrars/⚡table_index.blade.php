<?php

use App\Models\Registrar;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $status_filtro = '';


    protected $paginationTheme = 'tailwind';


    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Registrar::query()->withCount('domains')->whereNull('deleted_at')->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        });

        if ($this->status_filtro === 'ativos') {
            $query->withCount('accounts')->having('accounts_count', '>', 0);
        }

        if ($this->status_filtro === 'sem_contas') {
            $query->withCount('accounts')->having('accounts_count', '=', 0);
        }


        $registrars = $query->paginate(8);

        return view('components.registrars.⚡table_index', compact('registrars'));
    }


};
?>

<div class="space-y-4">

    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardBody'] }}">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="{{ $ui['label'] }} flex items-center gap-2">Pesquisar<div wire:loading><x-lucide-refresh-cw class="{{$ui['icon-size']}} animate-spin"/></div>
                    </label>
                    <input wire:model.live="search" id="search" type="search" class="{{ $ui['input'] }}" placeholder="Buscar por nome ou website" />
                </div>

                <div>
                    <label for="status_filtro" class="{{ $ui['label'] }}">Status</label>
                    <select wire:model.live="status_filtro" id="status_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        <option value="ativos">Com contas ativas</option>
                        <option value="sem_contas">Sem contas</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="{{ $ui['tableWrap'] }}">
        <table class="{{ $ui['table'] }}">
            <thead>
            <tr>
                <th class="{{ $ui['th'] }}">Nome</th>
                <th class="{{ $ui['th'] }}">Website</th>
                <th class="{{ $ui['th'] }}">Contas</th>
                <th class="{{ $ui['th'] }}">Domínios vinculados</th>
                <th class="{{ $ui['th'] }}">Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($registrars->count() > 0)
                @foreach($registrars as $registrar)
                    <tr>
                        <td class="{{ $ui['td'] }}">{{$registrar->name}}</td>
                        <td class="{{ $ui['td'] }}">{{$registrar->website}}</td>
                        <td class="{{ $ui['td'] }}">{{$registrar->accounts->count()}}</td>
                        <td class="{{ $ui['td'] }}">{{$registrar->domains_count}}</td>
                        <td class="{{ $ui['td'] }}">
                            <div class="flex flex-wrap gap-3">
                                <a class="text-slate-700 hover:text-slate-500" href="{{route('registrars.show', $registrar)}}"
                                   title="Ver detalhes">
                                    <x-lucide-file-search-corner class="{{ $ui['icon-size'] }}"/>
                                </a>
                                <a class="text-slate-700 hover:text-slate-500" href="{{route('registrars.edit', $registrar)}}"
                                   title="Editar">
                                    <x-lucide-edit class="{{ $ui['icon-size'] }}"/>
                                </a>
                                @can('user_is_admin')
                                    <a class="text-red-700 hover:text-red-500"
                                       href="{{route('registrars.confirm_delete', $registrar)}}" title="Deletar">
                                        <x-lucide-trash class="{{ $ui['icon-size'] }}  "/>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="{{ $ui['td'] }} text-center text-slate-500">Nenhum registrador encontrado.</td>
                </tr>
            @endif


            </tbody>
        </table>
    </section>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $registrars->links() }}
    </div>
</div>
