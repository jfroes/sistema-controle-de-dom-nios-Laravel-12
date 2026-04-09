<?php

use App\Models\Registrar;
use App\Models\RegistrarAccount;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $registrador_filtro = '';


    protected $paginationTheme = 'tailwind';



    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = RegistrarAccount::query()->with('registrar')->whereNull('deleted_at')->where(function ($q) {
            $q->where('label', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%');
        });

        if ($this->registrador_filtro ) {
            $query->where('registrar_id', $this->registrador_filtro);
        }


        $accounts = $query->paginate(8);
        $registrars = Registrar::all();

        return view('components.registrar_accounts.⚡table_index', compact('accounts', 'registrars'));
    }


};
?>

<div>
    <section class="{{ $ui['card'] }}">
        <div class="{{ $ui['cardBody'] }}">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="{{ $ui['label'] }}">Pesquisar</label>
                    <input wire:model.live="search" id="search" type="search" class="{{ $ui['input'] }}"
                           placeholder="Buscar por label ou username"/>
                </div>

                <div>
                    <label for="registrador_filtro" class="{{ $ui['label'] }}">Registrador</label>
                    <select wire:model.live="registrador_filtro" id="registrador_filtro" class="{{ $ui['input'] }}">
                        <option value="">Todos</option>
                        @foreach($registrars as $registrar)
                            <option value="{{$registrar->id}}">{{$registrar->name}}</option>

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
                <th class="{{ $ui['th'] }}">Registrador</th>
                <th class="{{ $ui['th'] }}">Label</th>
                <th class="{{ $ui['th'] }}">Username</th>
                <th class="{{ $ui['th'] }}">Domínios vinculados</th>
                <th class="{{ $ui['th'] }}">Ações</th>
            </tr>
            </thead>
            <tbody>

            @forelse($accounts as $account)
                <tr>
                    <td class="{{ $ui['td'] }}">{{$account->registrar->name}}</td>
                    <td class="{{ $ui['td'] }}">{{$account->label}}</td>
                    <td class="{{ $ui['td'] }}">{{$account->username}}</td>
                    <td class="{{ $ui['td'] }}">{{$account->domains->count()}}</td>
                    <td class="{{ $ui['td'] }}">
                        <div class="flex flex-wrap gap-3">
                            <a class="text-slate-700 hover:text-slate-500" href="{{route('registrar_accounts.show', $account)}}"
                               title="Ver detalhes">
                                <x-lucide-file-search-corner class="{{ $ui['icon-size'] }}"/>

                            </a>
                            <a class="text-slate-700 hover:text-slate-500" href="{{route('registrar_accounts.edit', $account)}}"
                               title="Editar">
                                <x-lucide-edit class="{{ $ui['icon-size'] }}"/>


                            </a>
                            @can('user_is_admin')
                                <a class="text-red-700 hover:text-red-500"
                                   href="{{route('registrar_accounts.confirm_delete', $account)}}" title="Deletar">
                                    <x-lucide-trash class="{{ $ui['icon-size'] }}  "/>
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="{{ $ui['td'] }} text-center text-slate-500">Nenhuma conta de registrador encontrada.</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </section>
</div>
