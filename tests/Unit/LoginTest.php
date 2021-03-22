<?php

namespace Tests\Unit;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;
    /**
     * Testa se o usuário consegue realizar o acesso corretamente.
     *
     * @return void
     */
    public function testLoginSucesso()
    {
        $senhaCadastrada = '123456789';
        
        $usuario = Usuario::factory()->state([
            'senha' => Hash::make($senhaCadastrada)
        ])->createOne();
        
        $response = $this->post(route('login.autenticar'), [
            'email' => $usuario->email,
            'senha' => $senhaCadastrada
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('home.index');
    }

    public function testLoginErro()
    {
        $response = $this->post(route('login.autenticar'), [
            'email' => 'admin@teste.com.br',
            'senha' => 'admin'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('authenticationError');
    }
}
