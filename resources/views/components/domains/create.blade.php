<x-layouts.main-layout title="Novo Domínio">
    <div class="space-y-6 max-w-4xl">
        <header>
            <h1 class="{{ $ui['title'] }}">Novo domínio</h1>
            <p class="{{ $ui['subtitle'] }} mt-1">Cadastre um domínio e vincule a um cliente já existente.</p>
        </header>

        <section class="{{ $ui['card'] }}">
            <div class="{{ $ui['cardBody'] }}">
                <form class="grid md:grid-cols-2 gap-4" action="{{route('domains.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="md:col-span-2">
                        <label class="{{ $ui['label'] }}" for="dominio">Domínio</label>
                        <input id="dominio" name="dominio" type="text" class="{{ $ui['input'] }}" placeholder="exemplo.com.br"  />
                        @error('dominio')
                            <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="cliente_id">Cliente</label>
                        <select id="cliente_id" name="cliente_id" class="{{ $ui['input'] }}" >
                            <option value=""
                                {{ old('cliente_id', $domain->client_id ?? '') == '' ? 'selected' : '' }}>
                                Selecione...
                            </option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('cliente_id', $domain->client_id ?? '') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="expira_em">Data de expiração</label>
                        <input id="expira_em" name="expira_em" type="date" class="{{ $ui['input'] }}"  />
                        @error('expira_em')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="host">Host</label>
                        <input id="host" name="host" type="text" class="{{ $ui['input'] }}" placeholder="ns1.exemplo.com" />
                        @error('host')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="usuario_host">Usuário host</label>
                        <input id="usuario_host" name="usuario_host" type="text" class="{{ $ui['input'] }}" placeholder="admin-host" />
                        @error('usuario_host')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="status">Status</label>
                        <select id="status" name="status" class="{{ $ui['input'] }}" >
                            <option value=""
                                {{ old('status', $domain->status ?? '') == '' ? 'selected' : '' }}>
                                Selecione...
                            </option>
                            @foreach($statuses as $status)
                                <option value="{{$status->value}}" {{ old('status', $domain->status->value ?? '') == $status->value ? 'selected' : '' }}>{{$status->label()}}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="{{ $ui['label'] }}" for="conta_registrador_id">Conta de registrador</label>
                        <select id="conta_registrador_id" name="conta_registrador_id" class="{{ $ui['input'] }}" >
                            <option value=""
                                {{ old('conta_registrador_id', $domain->registrar_account_id ?? '') == '' ? 'selected' : '' }}>
                                Selecione...
                            </option>
                            @foreach($registrarAccounts as $account)
                                <option value="{{$account->id}}" {{ old('conta_registrador_id', $domain->registrar_account_id ?? '') == $account->id ? 'selected' : '' }}>{{$account->label}} ({{$account->registrar->name}})</option>
                            @endforeach
                        </select>
                        @error('conta_registrador_id')
                        <span class="{{$ui['errorText']}}">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-wrap gap-3">
                        <button type="submit" class="{{ $ui['btnPrimary'] }}">Salvar domínio</button>
                        <a href="{{ url('admin/dominios') }}" class="{{ $ui['btnSecondary'] }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-layouts.main-layout>
