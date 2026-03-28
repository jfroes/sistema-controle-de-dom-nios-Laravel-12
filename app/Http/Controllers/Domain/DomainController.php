<?php

namespace App\Http\Controllers\Domain;

use App\Enums\DomainStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Registrar;
use App\Models\RegistrarAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        return view('components.domains.index');
    }

    public function show(Domain $domain): View
    {
        $domain = Domain::findOrFail($domain->id);


        return view('components.domains.show', compact('domain'));
    }

    public function create(): View
    {
        $clients = Client::all();
        $statuses = DomainStatusEnum::cases();
        $registrarAccounts = RegistrarAccount::all();
        return view('components.domains.create', compact('clients', 'statuses', 'registrarAccounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'dominio' => ['required', 'url', Rule::unique('domains', 'name'),'min:3', 'max:255'],
            'cliente_id' => 'required|exists:clients,id',
            'expira_em' => 'required|date|after:today',
            'host' => 'max:64',
            'usuario_host' => 'max:64',
            'status' => 'required',
            'conta_registrador_id' => 'required|exists:registrar_accounts,id',
        ],[
            'dominio.unique' => 'Este dominio já existe',
            'dominio.url' => 'O domínio deve ser uma URL válida',
            'dominio.required' => 'O domínio é obrigatório',
            'dominio.min' => 'O domínio deve ter pelo menos :min caracteres',
            'dominio.max' => 'O domínio deve ter no máximo :max caracteres',
            'cliente_id.required' => 'O cliente é obrigatório',
            'cliente_id.exists' => 'O cliente selecionado é inválido',
            'expira_em.required' => 'A data de expiração é obrigatória',
            'expira_em.date' => 'A data de expiração deve ser uma data válida',
            'expira_em.after' => 'A data de expiração deve ser uma data futura',
            'host.max' => 'O host deve ter no máximo :max caracteres',
            'usuario_host.max' => 'O usuário do host deve ter no máximo :max caracteres',
            'status.required' => 'O status é obrigatório',
            'conta_registrador_id.required' => 'A conta do registrador é obrigatória',
            'conta_registrador_id.exists' => 'A conta do registrador selecionada é inválida',
        ]);

        $domain = new Domain();

        $this->extracted($request, $domain);

        if ($domain->save()) {
            return redirect()->route('domains.index')->with('success', 'Domínio cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o domínio. Por favor, tente novamente.');
    }

    public function edit(Domain $domain): View
    {
        $domain = Domain::findOrFail($domain->id);
        $registrarAccounts = RegistrarAccount::all();
        $clients = Client::all();
        $statuses = DomainStatusEnum::cases();

        return view('components.domains.edit', compact('registrarAccounts',  'domain', 'clients', 'statuses'));
    }

    public function update(Request $request, Domain $domain): RedirectResponse
    {
        $request->validate([
            'dominio' => ['required', 'url', Rule::unique('domains', 'name')->ignore($domain->id),'min:3', 'max:255'],
            'cliente_id' => 'required|exists:clients,id',
            'expira_em' => 'required|date|after:today',
            'host' => 'max:64',
            'usuario_host' => 'max:64',
            'status' => 'required',
            'conta_registrador_id' => 'required|exists:registrar_accounts,id',
        ],[
            'dominio.required' => 'O domínio é obrigatório',
            'dominio.url' => 'O domínio deve ser uma URL válida',
            'dominio.unique' => 'O domínio já existe',
            'dominio.min' => 'O domínio deve ter pelo menos :min caracteres',
            'dominio.max' => 'O domínio deve ter no máximo :max caracteres',
            'cliente_id.required' => 'O cliente é obrigatório',
            'cliente_id.exists' => 'O cliente selecionado é inválido',
            'expira_em.required' => 'A data de expiração é obrigatória',
            'expira_em.date' => 'A data de expiração deve ser uma data válida',
            'expira_em.after' => 'A data de expiração deve ser uma data futura',
            'host.max' => 'O host deve ter no máximo :max caracteres',
            'usuario_host.max' => 'O usuário do host deve ter no máximo :max caracteres',
            'status.required' => 'O status é obrigatório',
            'conta_registrador_id.required' => 'A conta do registrador é obrigatória',
            'conta_registrador_id.exists' => 'A conta do registrador selecionada é inválida',
        ]);

        $this->extracted($request, $domain);

        if ($domain->save()) {
             return redirect()->back()->with('success', 'Domínio atualizado com sucesso!');
         }

        return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o domínio. Por favor, tente novamente.');
    }

    public function deleteConfirmation(Domain $domain): View
    {
        return view('components.domains.delete_confirmation', compact('domain'));
    }

    public function destroy(Request $request, Domain $domain): RedirectResponse
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'min:4', 'max:255', "in:$domain->name"],
        ],[
            'confirmation_text.required' => 'A confirmação é obrigatória',
            'confirmation_text.string' => 'A confirmação deve ser uma string',
            'confirmation_text.min' => 'A confirmação deve ter pelo menos :min caracteres',
            'confirmation_text.max' => 'A confirmação deve ter no máximo :max caracteres',
            'confirmation_text.in' => 'A confirmação deve ser igual ao nome do domínio',
        ]);

        Gate::authorize('can_delete_domains', $domain);

        $domain->delete();

        return redirect()->route('domains.index')->with('success', 'Domínio deletado com sucesso!');
    }

    /**
     * @param Request $request
     * @param Domain $domain
     * @return void
     */
    public function extracted(Request $request, Domain $domain): void
    {
        $domain->name = $request->dominio;
        $domain->client_id = $request->cliente_id;
        $domain->expires_at = Carbon::create($request->expira_em)->toDate();
        $domain->host = $request->host;
        $domain->host_user = $request->usuario_host;
        $domain->status = $request->status;
        $domain->registrar_account_id = $request->conta_registrador_id;
        $domain->updated_at = Carbon::now();
    }

}
