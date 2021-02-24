<?php

namespace Tests\Feature;

use App\Models\Servico;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            ->post(route('servico.store', [
                'id' => $params['fotografo']
            ]), $params);

        $response->assertStatus(200);
        $response->assertViewIs('servico.novo.sucesso');
        $this->assertDatabaseHas(Servico::TABLE_NAME, [
            'cliente_id' => $cliente->id,
            'fotografo_id' => $params['fotografo'],
            'status' => 'criado',
            'avaliado' => false
        ]);
    }

    public function testFotografoAtualizarStatusServicoSucesso()
    {
        $this->seed('CreateProfileTypes');

        $servico = Servico::factory()->createOne();
        $fotografo = $servico->fotografo;

        $status = 'em analise';

        $response = $this->actingAs($fotografo)
            ->patch(route('fotografo.servico.update.status', ['servico' => $servico->id, 'status' => $status]));

        $response->assertRedirect(route('servico.index'));

        $this->assertDatabaseHas('fl_servicos', [
            'id' => $servico->id,
            'status' => $status
        ]);
    }

    public function testClienteAtualizarStatusServicoSucesso()
    {
        $this->seed('CreateProfileTypes');

        $servico = Servico::factory()->createOne();
        $cliente = $servico->cliente;

        $status = 'cancelado';

        $response = $this->actingAs($cliente)
            ->patch(route('cliente.servico.update.status', ['servico' => $servico->id, 'status' => $status]));

        $response->assertRedirect(route('servico.index'));

        $this->assertDatabaseHas('fl_servicos', [
            'id' => $servico->id,
            'status' => $status
        ]);
    }

    public function testClienteAtualizarServicoSucesso()
    {
        $this->seed('CreateProfileTypes');

        $servico = Servico::factory()->createOne();
        $cliente = $servico->cliente;

        $dataInicio = $this->faker->dateTime;
        $dataFim = $this->faker->dateTimeBetween('+10 days', '+20 days');

        $params = [
            'data_inicio' => $dataInicio->format('d/m/Y H:i'),
            'data_fim' => $dataFim->format('d/m/Y H:i'),
            'titulo' => 'titulo_alterado',
            'descricao' => 'descricao alterada'
        ];

        $response = $this->actingAs($cliente)
            ->patch(route('servico.update', [
                'servico' => $servico->id
            ]), $params);

        $response->assertRedirect(route('servico.index'));

        $this->assertDatabaseHas('fl_servicos', [
            'titulo' => $params['titulo'],
            'descricao' => $params['descricao'],
            'data_inicio' => $dataInicio->format('Y-m-d H:i'),
            'data_fim' => $dataFim->format('Y-m-d H:i'),
        ]);
    }
}
