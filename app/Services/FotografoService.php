<?php

namespace App\Services;


use App\DTOs\DadosCadastroServicoService;
use App\Models\Fotografo;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;

class FotografoService
{

    public function cadastrarNovoServico(DadosCadastroServicoService $dadosCadastroServico)
    {
        $fotografo = Fotografo::findOrFail($dadosCadastroServico->fotografo);

        $servico = Servico::fromDadosCadastro($dadosCadastroServico);

        $fotografo->servico()->save($servico);
    }
}
