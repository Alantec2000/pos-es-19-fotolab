<?php

namespace Tests\Feature;

use App\Models\TipoPerfil;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use WithFaker;

    public function testCriarUsuarioComSucesso()
    {
        $params = $this->obterParametros();

        $response = $this->post("/usuario/cadastro/criar", $params);

        $this->assertNotNull(Usuario::whereEmail($params['email'])->first());
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
        
        $response = $this->post("/usuario/cadastro/criar", $params);
        
        Storage::assertExists(storage_path("app/imgs/foto_perfil/{$params['foto_perfil']->hashName()}"));
        $response->assertStatus(200);

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
        $response = $this->post("/usuario/cadastro/criar", $params);

        
        Storage::assertMissing(
            storage_path("app/imgs/foto_capa/{$params['foto_capa']->hashName()}")
        );
        $response->assertStatus(200);
 
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
        
        $response = $this->post("/usuario/cadastro/criar", $params);

        Storage::assertExists(
            storage_path("app/imgs/foto_capa/{$params['foto_capa']->hashName()}")
        );
        $response->assertStatus(200);

        $this->assertDatabaseHas('fl_usuarios', [
            'id' => $this->getResponseData($response, 'id'),
            'url_foto_capa' => $params['foto_capa']->hashName()
        ]);
    }

    public function obterParametros(string $nomeTipoPerfil = null)
    {
        $params = [
            'email' => $this->faker->email(),
            'senha' => $this->faker->password(8,15),
            'nome' => $this->faker->firstName(),
            'sobrenome' => $this->faker->lastName(),
            'data_nascimento' => $this->faker->date('d/m/Y'),
            'tipo' => strtolower($nomeTipoPerfil ?? TipoPerfil::inRandomOrder()->first()->nome)
        ];

        return $params;
    }
}
