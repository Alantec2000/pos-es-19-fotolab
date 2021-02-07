<?php

namespace App\Models;

use App\DTOs\DadosCadastroServicoService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Servico extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fl_servicos';

    protected $table = self::TABLE_NAME;

    public $attributes = [
        'status' => 'criado',
        'avaliado' => false
    ];
    public $fillable = [
        'fotografo_id',
        'cliente_id',
        'data_inicio',
        'data_fim',
        'titulo',
        'descricao'
    ];

    public function setDataInicioAttribute($value)
    {
        $this->attributes['data_inicio'] = Carbon::createFromFormat('d/m/Y H:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public function setDataFimAttribute($value)
    {
        $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y H:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public static function fromDadosCadastro(DadosCadastroServicoService $dadosCadastroServico): self
    {
        return new self([
            'fotografo_id' => $dadosCadastroServico->fotografo,
            'cliente_id' => Auth::user()->id,
            'data_inicio' => $dadosCadastroServico->data_inicio,
            'data_fim' => $dadosCadastroServico->data_fim,
            'titulo' => $dadosCadastroServico->titulo,
            'descricao' => $dadosCadastroServico->descricao,
        ]);
    }
}
