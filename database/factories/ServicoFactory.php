<?php

namespace Database\Factories;

use App\Models\Servico;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => Usuario::factory()->cliente(),
            'fotografo_id' => Usuario::factory()->fotografo(),
            'titulo' => $this->faker->title,
            'descricao' => $this->faker->sentence,
            'data_inicio' => Carbon::now()->format('d/m/Y H:m'),
            'data_fim' => $this->faker->dateTimeBetween('+5 days', '+10 days')->format('d/m/Y H:m'),
            'status' => 'criado',
            'avaliado' => false,
        ];
    }
}
