<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Registrar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrarController extends Controller
{
    //

    public function index(): View
    {
        return view('components.registrars.index');
    }

    public function show(Registrar $registrar): View
    {
        $registrar = Registrar::with(['domains.client'])->whereNull('deleted_at')->findOrFail($registrar->id);

        return view('components.registrars.show', compact('registrar'));
    }

    public function create(): View
    {
        return view('components.registrars.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:64|unique:registrars,name',
        ],[
            'nome.reqired' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.min' => 'O campo nome deve conter no mínimo :min caracteres.',
            'nome.max' => 'O campo nome deve conter no máximo :max caracteres.',
            'nome.unique' => 'Já existe registrador com esse nome.',
        ]);

        $registrar = new Registrar();
        $registrar->name = $request->nome;
        $registrar->website = $request->website;
        $registrar->save();

        return redirect()->route('registrars.index')->with('success', 'Registrador criado com sucesso.');
    }

    public function edit(Registrar $registrar): View
    {
        return view('components.registrars.edit', compact('registrar'));
    }

    public function update(Request $request, Registrar $registrar): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'min:3', 'max:64','unique:registrars,name', Rule::unique('registrars', 'name')->ignore($registrar->id)],
        ],[
            'nome.reqired' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.min' => 'O campo nome deve conter no mínimo :min caracteres.',
            'nome.max' => 'O campo nome deve conter no máximo :max caracteres.',
            'nome.unique' => 'Já existe registrador com esse nome.',
        ]);

        if (!$registrar){
            return redirect()->route('registrars.index')->with('error', 'Registrador não encontrado.');
        }

        $registrar->name = $request->nome;
        $registrar->website = $request->website;

        if (!$registrar->save()) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o registrador. Por favor, tente novamente.');
        }

        return  redirect()->route('registrars.index')->with('success', 'Registrador atualizado com sucesso.');
    }

    public function confirm_delete(Registrar $registrar): View
    {
        return view('components.registrars.confirm_delete', compact('registrar'));
    }

    public function destroy(Request $request, Registrar $registrar): RedirectResponse
    {
        $request->validate([
            'confirmation_text' => ['required', 'in:'.$registrar->name],
        ],[
            'confirmation_text.required' => 'A confirmação é obrigatória.',
            'confirmation_text.in' => 'A confirmação deve ser igual ao nome do registrador.',
        ]);

        if ($registrar->domains()->count() > 0) {
            return redirect()->route('registrars.index')->with('error', 'Não é possível remover um registrador que possui domínios associados. Por favor, remova ou transfira os domínios antes de tentar novamente.');
        }

        if ($registrar->delete()) {
            return redirect()->route('registrars.index')->with('success', 'Registrador removido com sucesso.');
        }

        return redirect()->route('registrars.index')->with('error', 'Ocorreu um erro ao remover o registrador. Por favor, tente novamente.');
    }
}
