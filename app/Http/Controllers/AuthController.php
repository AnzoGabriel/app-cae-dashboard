<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthPostRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function auth(AuthPostRequest $request)
    {
        $response = Http::withOptions(['verify' => false])->post('https://suap.ifto.edu.br/api/v2/autenticacao/token/', [
            'username' => $request->n_matricula,
            'password' => $request->password,
        ]);

        if ($response->successful() && $response->json('access') && $response->json('refresh')) {
            // Armazenar o token de acesso na sessão ou em outro lugar
            $token = $response->json('access');
            $refresh_token = $response->json('refresh');
            Session::put('api_token', $token);
            Session::put('api_refresh_token', $refresh_token);

            // Redirecionar para o dashboard
            return redirect()->route('user.info');
        } else {
            // Tratar erro de autenticação
            return back()->withErrors([
                'auth_error' => 'As credenciais fornecidas são incorretas.',
            ]);
        }
    }
}
