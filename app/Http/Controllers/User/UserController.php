<?php

namespace App\Http\Controllers\User;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Mail\NewUserConfirmation;
use App\Mail\ResetPassword;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function dashboard(): View
    {
        $domains = Domain::all();
        $expiresIn30days = $domains->filter(function ($domain) {
            return $domain->expires_at > Carbon::now() && $domain->expires_at <= Carbon::now()->addDays(30);
        });

        $expired = $domains->filter(function ($domain) {
            return $domain->expires_at <= Carbon::now();
        });

        return view('components.admin.dashboard', compact('domains', 'expiresIn30days', 'expired'));
    }

    public function create(): View{
        $roles = UserRoleEnum::cases();

        return view('components.user.create_user', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'senha_temporaria' => ['required', 'string', 'min:8', 'max:32'],
            'perfil' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter pelo menos :min caracteres',
            'name.max' => 'O nome deve ter até :max caracteres',
            'email.required' => 'O e-email é obrigatório',
            'email.email' => 'E-mail deve ser um endereco válido',
            'email.unique' => 'E-mail inválido',
            'senha_temporaria.required' => 'A senha é obrigatória',
            'senha_temporaria.min' => 'A senha deve ter pelo menos :min caracteres',
            'senha_temporaria.max' => 'A senha deve ter no máximo :max caracteres'

        ]);

        $user = new User();

        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->senha_temporaria);
        $user->role = $request->perfil;
        $user->token = Str::random(64);
        $user->must_change_password = true;


        $result = Mail::to($user->email)->send(new NewUserConfirmation($user->full_name, $user->email, $request->senha_temporaria));

        if (!$result){
            return redirect()->back()->with('error', 'Erro ao enviar o e-mail de confirmação de cadastro.');
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'E-mail de confirmação enviado ao usuário com sucesso.');
    }

    public function index(): View
    {
        $users = User::all();

        return view('components.user.index_users', compact('users'));
    }

    public function show(User $user): View{
        return view('components.user.show_user', compact('user'));
    }

    public function edit(User $user): View{
        $roles = UserRoleEnum::cases();

        return view('components.user.edit_user', compact(['user', 'roles']));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ],[
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter pelo menos :min caracteres',
            'name.max' => 'O nome deve ter até :max caracteres',
            'email.required' => 'O e-email é obrigatório',
            'email.email' => 'E-mail deve ser um endereco válido',
            'email.unique' => 'E-mail inválido',
        ]);

        $user->full_name = $request->nome;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('success', 'Atualizado com sucesso!');
    }

    public function setUserStatus(User $user): RedirectResponse
    {

        if ($user->status == UserStatusEnum::ACTIVE){
            $user->status = UserStatusEnum::BLOCKED;
            $user->save();
        }else{
            $user->status = UserStatusEnum::ACTIVE;
            $user->save();
        }

        return redirect()->back()->with(['success' => 'Status alterado com sucesso!']);
    }

    public function changePassword(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'senha_temporaria' => ['required', 'string', 'min:8', 'max:32'],
        ],[
            'senha_temporaria.required' => 'A senha é obrigatória',
            'senha_temporaria.min' => 'A senha deve ter pelo menos :min caracteres',
            'senha_temporaria.max' => 'A senha deve ter no máximo :max caracteres'
        ]);

        $user->password = bcrypt($request->senha_temporaria);
        $user->must_change_password  = true;
        $user->save();

        return redirect()->back()->with('success', 'Senha alterada com sucesso!');
    }

    public function deleteConfirmation(Request $request, User $user): View
    {
        return view('components.user.delete_confirmation_user', compact(['user']));
    }

    public function destroy(User $user){
        Gate::authorize('can_delete_users', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');;
    }
}
