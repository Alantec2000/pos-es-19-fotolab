<?php

namespace Tests\Feature;

use App\Models\Fotografo;
use App\Models\Servico;
use App\Models\TipoPerfil;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ServicoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCadastrarServicoSucesso()
    {
        $params = [
            'fotografo' => Usuario::factory()->create()->id,
            'data_inicio' => Carbon::now()->format('d/m/Y H:m'),
            'data_fim' => $this->faker->dateTimeBetween('+5 days', '+10 days')->format('d/m/Y H:m'),
            'titulo' => $this->faker->title,
            'descricao' => $this->faker->sentence(10),
        ];

        $cliente = Usuario::factory()->cliente()->createOne();

        $response = $this->actingAs($cliente)
            ->post(route('fotografo.servico.novo', [
                'id' => $params['fotografo']
            ]), $params);

        $response->assertStatus(200);
        $response->assertViewIs('fotografo.servico.novo.sucesso');
        $this->assertDatabaseHas(Servico::TABLE_NAME, [
            'cliente_id' => $cliente->id,
            'fotografo_id' => $params['fotografo'],
            'status' => 'criado',
            'avaliado' => false
        ]);
    }
}
