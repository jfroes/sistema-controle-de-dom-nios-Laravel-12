<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('components.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ],[
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'email.exists' => 'Usuário ou senha incorretos',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $credentials = [
          'email' => $request->email,
          'password' => $request->password,
          'status' => UserStatusEnum::ACTIVE->value,
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if (Auth::user()->must_change_password){
                $email = $credentials['email'];
                return redirect()->route('first-login');
            }

            Auth::user()->last_login_at = now();
            Auth::user()->save();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withInput()->with(['error' => 'Login inválido.']);
    }

    public function firstLogin(): View
    {
        return view('components.auth.first-login');
    }

    public function passwordChange(Request $request): RedirectResponse
    {

        $request->validate([
            'senha_nova' => ['required', 'string', 'min:8', 'max:18', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/','confirmed'],
        ],[
            'senha_nova.required'   => 'Informe a nova senha.',
            'senha_nova.string'     => 'A nova senha deve ser um texto válido.',
            'senha_nova.min'        => 'A nova senha deve ter pelo menos :min caracteres.',
            'senha_nova.max'        => 'A nova senha deve ter no máximo :max caracteres.',
            'senha_nova.regex'      => 'A nova senha deve ter ao menos 1 letra maiúscula, 1 número e 1 caractere especial.',
            'senha_nova.confirmed'  => 'A confirmação deve ser igual à nova senha.',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->senha_nova);
        $user->must_change_password = false;
        $user->password_changed_at = Carbon::now();
        $user->last_login_at = Carbon::now();
        $user->status = UserStatusEnum::ACTIVE->value;
        $user->save();

        Auth::user()->password = $request->nova_senha;
        return redirect()->route('dashboard')->with('success', 'Senha alterada com sucesso.');
    }

    public function forgotPassword(): View
    {
        return view('components.auth.forgot-password');
    }

    public function sendResetEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ],[
            'email.required' => 'O email é obrigatorio.',
            'email.email' => 'Email deve ser um endereco válido.',
        ]);

        $genericMessage = 'Verifique sua caixa de entrada para prosseguir com a recuperacao de senha.';

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return redirect()->back()->with('success', $genericMessage);
        }

        $user->token = Str::random(64);

        $linkWithToken = route('reset-password', ['token' => $user->token]);

        $result = Mail::to($user->email)->send(new ResetPassword($user->full_name, $linkWithToken));

        if (!$result){
            return redirect()->back()->with('success', $genericMessage);
        }

        $user->save();

        return redirect()->back()->with('success', $genericMessage);
    }

    public function resetPassword($token): View | RedirectResponse
    {
        $user = User::where('token', $token)->first();

        if(!$user){
            return redirect()->route('login');
        }

        return view('components.auth.reset-password', ['token' => $token]);

    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'senha_nova' => ['required', 'string', 'min:8', 'max:18', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/','confirmed'],
        ],[
            'senha_nova.required'   => 'Informe a nova senha.',
            'senha_nova.string'     => 'A nova senha deve ser um texto válido.',
            'senha_nova.min'        => 'A nova senha deve ter pelo menos :min caracteres.',
            'senha_nova.max'        => 'A nova senha deve ter no máximo :max caracteres.',
            'senha_nova.regex'      => 'A nova senha deve ter ao menos 1 letra maiúscula, 1 número e 1 caractere especial.',
            'senha_nova.confirmed'  => 'A confirmação deve ser igual à nova senha.',
        ]);

        $user = User::where('token', $request->token)->first();


        if (!$user || $user->status == UserStatusEnum::BLOCKED || $user->status == UserStatusEnum::INACTIVE){
            return redirect()->route('login')->with('warning', 'Entre em contato com um administrador.');
        }

        $user->password = bcrypt($request->senha_nova);
        $user->must_change_password = false;
        $user->password_changed_at = Carbon::now();
        $user->token = null;
        $user->save();

        $credentials = [
            'email' => $user->email,
            'password' => $request->senha_nova,
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            Auth::user()->last_login_at = now();
            Auth::user()->save();
            return redirect()->route('dashboard')->with('success', 'Senha alterada com sucesso.');
        }

        return redirect()->route('login')->with('success', 'Senha alterada com sucesso.');
    }


    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
