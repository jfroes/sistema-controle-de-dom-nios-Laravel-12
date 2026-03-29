<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index()
    {
        return view('components.client.index');
    }

    public function create(): View
    {
        return view('components.client.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'unique:clients,name', 'min:3', 'max:32'],
        ],[
            'nome.required' => 'O nome é obrigatorio.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O nome deve ter pelo menos 64 caracteres.',
            'nome.unique' => 'Esse cliente já existe.',
        ]);

        $client = new Client();

        $client->name = $request->nome;
        if ($client->save()) {
            return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso.');
        }

            return redirect()->back()->with('error', 'Ocorreu um erro ao criar o cliente. Tente novamente.');


    }

    public function show(Client $client): View
    {
        $client = Client::find($client->id);
        return view('components.client.show', compact('client', 'client'));
    }

    public function edit(Client $client): View
    {
        $client = Client::find($client->id);
        return view('components.client.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', Rule::unique('clients', 'name')->ignore($client->id), 'min:3', 'max:32'],
        ],[
            'nome.required' => 'O nome é obrigatorio.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O nome deve ter pelo menos 64 caracteres.',
            'nome.unique' => 'Esse cliente já existe.',
        ]);

        $client = Client::find($client->id);
        $client->name = $request->nome;
        if ($client->save()) {
            return redirect()->back()->with('success', 'Cliente atualizado com sucesso.');
        }

        return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o cliente. Tente novamente.');

    }

    public function confirm_delete(Client $client): View
    {
        return view('components.client.delete_confirmation', compact('client'));
    }

    public function destroy(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'min:4', 'max:255', "in:$client->name"],
        ],[
            'confirmation_text.required' => 'A confirmação é obrigatória',
            'confirmation_text.string' => 'A confirmação deve ser uma string',
            'confirmation_text.min' => 'A confirmação deve ter pelo menos :min caracteres',
            'confirmation_text.max' => 'A confirmação deve ter no máximo :max caracteres',
            'confirmation_text.in' => 'A confirmação deve ser igual ao nome do domínio',
        ]);

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso!');
    }


}
