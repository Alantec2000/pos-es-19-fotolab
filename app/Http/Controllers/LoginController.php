<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function signin() 
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('login.index');
    }

    public function logout() 
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        Auth::logout();

        return redirect('/');
    }

    public function signout()
    {
        $params = request()->all();
        
        $validation = Validator::make($params, [
            'email' => 'required|string',
            'senha' => 'required|string'
        ]);

        if ($validation->fails()) {
            $responseContent = [
                'status' => 'error',
                'data' => $validation->errors()
            ];
            return response($responseContent, 403);
        }

        Auth::logout();

        return redirect('/');
    }

    public function autenticarUsuario(AuthenticationRequest $request)
    {
        $authenticationParams = $request->validated();

        $authenticationParams = [
            'email' => $authenticationParams['email'],
            'password' => $authenticationParams['senha']
        ];

        if (!Auth::attempt($authenticationParams)) {
            return redirect('/signin')->withErrors([
                'authenticationError' => trans('Login.authentication.error')
            ]);
        }

        return view('home.index');
    }
}
