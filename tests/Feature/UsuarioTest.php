<?php

namespace Tests\Feature;

use App\Models\TipoPerfil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testCriarUsuarioComSucesso()
    {
        $params = $this->obterParametros();

        $response = $this->post(route('usuario.cadastro.novo'), $params);

        $this->assertDatabaseHas('fl_usuarios', [
            'email' => $params['email']
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('usuario.cadastro.sucesso');
        $response->assertViewHas('nome_usuario', $params['nome']);
        $response->assertViewHas('id');
    }

    public function testCriarUsuarioComFotoPerfil()
    {
        Storage::fake('imgs_foto_perfil');

        $params = $this->obterParametros();
        $params['foto_perfil'] = UploadedFile::fake()->image('minha_foto_perfil.jpg');

        $response = $this->post(route('usuario.cadastro.novo'), $params);

        $response->assertStatus(200);
        Storage::disk('imgs_foto_perfil')
            ->assertExists($params['foto_perfil']->hashName());

        $this->assertDatabaseHas('fl_usuarios', [
            'id' => $this->getResponseData($response, 'id'),
            'url_foto_perfil' => $params['foto_perfil']->hashName()
        ]);
    }

    public function testCriarClienteComFotoCapa()
    {
        Storage::fake('imgs_foto_capa');
        $params = $this->obterParametros('Cliente');

        $params['foto_capa'] = UploadedFile::fake()->image('minha_foto_capa.jpg');
        $response = $this->post(route('usuario.cadastro.novo'), $params);

        $response->assertStatus(200);
        Storage::disk('imgs_foto_capa')->assertMissing(
            $params['foto_capa']->hashName()
        );

        $this->assertDatabaseHas('fl_usuarios', [
            'id' => $this->getResponseData($response, 'id'),
            'url_foto_capa' => null
        ]);
    }

    public function testCriarFotografoComFotoCapa()
    {
        Storage::fake('imgs_foto_capa');
        $params = $this->obterParametros('Fotografo');
        $params['foto_capa'] = UploadedFile::fake()->image('minha_foto_capa.jpg');

        $response = $this->post(route('usuario.cadastro.novo'), $params);

        $response->assertStatus(200);
        Storage::disk('imgs_foto_capa')->assertExists(
            $params['foto_capa']->hashName()
        );

        $this->assertDatabaseHas('fl_usuarios', [
            'id' => $this->getResponseData($response, 'id'),
            'url_foto_capa' => $params['foto_capa']->hashName()
        ]);
    }

    public function obterParametros(string $nomeTipoPerfil = null)
    {
        $tipoFactory = TipoPerfil::factory();
        $tipoParams = !$nomeTipoPerfil ? [] : ['nome' => $nomeTipoPerfil];

        $params = [
            'email' => $this->faker->safeEmail,
            'senha' => $this->faker->password(8, 15),
            'nome' => $this->faker->firstName(),
            'sobrenome' => $this->faker->lastName,
            'data_nascimento' => $this->faker->date('d/m/Y'),
            'tipo' => strtolower($tipoFactory->create($tipoParams)->nome)
        ];

        return $params;
    }
}
