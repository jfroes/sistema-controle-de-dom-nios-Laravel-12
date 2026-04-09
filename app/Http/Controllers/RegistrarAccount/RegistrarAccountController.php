<?php

namespace App\Http\Controllers\RegistrarAccount;

use App\Http\Controllers\Controller;
use App\Models\Registrar;
use App\Models\RegistrarAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegistrarAccountController extends Controller
{
    public function index(): View
    {
        return view('components.registrar_accounts.index');
    }

    public function show(RegistrarAccount $registrar_account): View
    {
        return view('components.registrar_accounts.show', compact('registrar_account'));
    }

    public function create(): View
    {
        $registrars = Registrar::all();
        return view('components.registrar_accounts.create', compact('registrars'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'registrador_id' =>['required', 'exists:registrars,id'],
            'label' =>  ['required', 'string','unique:registrar_accounts,label', 'min:3','max:64'],
            'username' =>['required', 'string', 'min:3','max:64'],
            'notas' => ['nullable', 'string'],
        ],[
            'registrador_id.required' => 'O campo "Registrador" é obrigatório.',
            'registrador_id.exists' => 'Registrador inválido',
            'label.required' => 'O campo "Label" é obrigatório.',
            'label.string' => 'O campo "Label" deve ser uma string.',
            'label.unique' => 'Já existe uma conta de registrador com esse "Label".',
            'label.min' => 'O campo "Label" deve ter no :min 3 caracteres.',
            'label.max' => 'O campo "Label" deve ter no :max 64 caracteres',
            'username.required' => 'O campo "Username" é obrigatório.',
            'username.string' => 'O campo "Username" deve ser uma string.',
            'username.min' => 'O campo "Username" deve ter no :min 3 caracteres.',
            'username.max' => 'O campo "Username" deve ter no :max 64 caracteres',
            'notas.string' => 'O campo "Notas" deve ser uma string.',
            ]);

        $account = new RegistrarAccount();
        $account->registrar_id = $request->registrador_id;
        $account->label = $request->label;
        $account->username = $request->username;
        $account->notes = $request->notas;

        if ($account->save()) {
            return redirect()->route('registrar_accounts.index')->with('success', 'Conta de Registrador criada com sucesso!');

        }
        return redirect()->back()->with('error', 'Ocorreu um erro ao criar a conta de registrador. Por favor, tente novamente.');
    }

    public function edit(RegistrarAccount $registrar_account): View
    {
        $registrars = Registrar::all();
        return view('components.registrar_accounts.edit', compact('registrar_account', 'registrars'));
    }


    public function update(Request $request, RegistrarAccount $registrar_account): RedirectResponse
    {
        $request->validate([
            'registrador_id' =>['required', 'exists:registrars,id'],
            'label' => ['required', 'string',Rule::unique('registrar_accounts', 'label')->ignore($registrar_account->id), 'min:3','max:64'],
            'username' => ['nullable', 'string','max:64'],
            'notas' => ['nullable', 'string', 'max:256'],
        ],[
            'registrador_id.required' => 'É obrigatório selecionar um registrador.',
            'registrador_id.exists' => 'O registrador selecionado é inválido.',
            'label.required' => 'O campo "Label" é obrigatório.',
            'label.string' => 'O campo "Label" deve ser uma string.',
            'label.unique' => 'Já existe uma conta de registrador com esse "Label".',
            'label.min' => 'O campo "Label" deve ter no mínimo :min caracteres.',
            'label.max' => 'O campo "Label" deve ter no máximo :max caracteres.',
            'username.string' => 'O campo "Username" deve ser uma string.',
            'username.max' => 'O campo "Username" deve ter no máximo :max caracteres.',
            'notas.string' => 'O campo "Notas" deve ser uma string.',
            'notas.max' => 'O campo "Notas" deve ter no máximo :max caracteres.',
        ]);

        $registrar_account->registrar_id = $request->registrador_id;
        $registrar_account->label = $request->label;
        $registrar_account->username = $request->username;
        $registrar_account->notes = $request->notas;
        if ($registrar_account->save()) {
            return redirect()->back()->with('success', 'Alterações salvas com sucesso!');
        }
        return redirect()->back()->with('error', 'Ocorreu um erro ao editar a conta de registrador. Por favor, tente novamente.');
    }

    public function confirm_delete(RegistrarAccount $registrar_account): View
    {
        return  view('components.registrar_accounts.delete_confirmation', compact('registrar_account'));
    }

    public function destroy(Request $request, RegistrarAccount $registrar_account): RedirectResponse
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'min:4', 'max:255', "in:$registrar_account->label"],
        ],[
            'confirmation_text.required' => 'A confirmação é obrigatória',
            'confirmation_text.string' => 'A confirmação deve ser uma string',
            'confirmation_text.min' => 'A confirmação deve ter pelo menos :min caracteres',
            'confirmation_text.max' => 'A confirmação deve ter no máximo :max caracteres',
            'confirmation_text.in' => 'A confirmação deve ser igual ao nome da conta de registrador',
         ]);

        if ($registrar_account->delete()) {;
            return redirect()->route('registrar_accounts.index')->with('success', 'Conta de registrador deletada com sucesso!');
        }

        return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a conta de registrador. Por favor, tente novamente.');
    }
}
