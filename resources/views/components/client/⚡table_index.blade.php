<?php

use App\Enums\DomainStatusEnum;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Registrar;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $site_filtro = '';


    protected $paginationTheme = 'tailwind';


    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Client::query()->whereNull('deleted_at')->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        });

        if ($this->site_filtro === 'com_site') {
            $query->withCount('domains')->having('domains_count', '>', 0);
        }

        if ($this->site_filtro === 'sem_site') {
            $query->withCount('domains')->having('domains_count', '=', 0);
        }

        $clients = $query->paginate(10);

        return view('components.client.⚡table_index', compact('clients'));
    }


};
?>

<div class="space-y-4">

    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardBody'] }} space-y-4">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="{{ $ui['label'] }}">Pesquisar
                        <div wire:loading class="text-xs italic text-slate-500 ml-2"><x-lucide-refresh-cw class="{{$ui['icon-size']}} animate-spin"/></div>
                    </label>
                    <input wire:model.live="search" id="search" type="search" class="{{ $ui['input'] }}"
                           placeholder="Buscar por nome"/>

                </div>

                <div>
                    <label for="site_filtro" class="{{ $ui['label'] }}">Domínios</label>
                    <select wire:model.live="site_filtro" id="site_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        <option value="com_site">Com domínios</option>
                        <option value="sem_site">Sem domínios</option>
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
                <th class="{{ $ui['th'] }}">Quantidade de domínios</th>
                <th class="{{ $ui['th'] }}">Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($clients->count() > 0)
                @foreach($clients as $client)
                    <tr>
                        <td class="{{ $ui['td'] }}">{{$client->name}}</td>
                        <td class="{{ $ui['td'] }}">{{$client->domains->count()}}</td>
                        <td class="{{ $ui['td'] }}">
                            <div class="flex flex-wrap gap-3">
                                <a class="text-slate-700 hover:text-slate-500" href="{{route('clients.show', $client)}}"
                                   title="Ver detalhes">
                                    <x-lucide-file-search-corner class="{{ $ui['icon-size'] }}"/>

                                </a>
                                <a class="text-slate-700 hover:text-slate-500" href="{{route('clients.edit', $client)}}"
                                   title="Editar">
                                    <x-lucide-edit class="{{ $ui['icon-size'] }}"/>


                                </a>
                                @can('user_is_admin')
                                    <a class="text-red-700 hover:text-red-500"
                                       href="{{route('clients.confirm_delete', $client)}}" title="Deletar">
                                        <x-lucide-trash class="{{ $ui['icon-size'] }}  "/>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="{{ $ui['td'] }} text-center py-6 text-slate-500">Nenhum cliente encontrado.
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </section>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
