<?php


namespace App\Services;

use App\DTOs\DadosAtualizacaoServico;
use App\DTOs\DadosCadastroServicoService;
use App\Models\Fotografo;
use App\Models\Servico;
use App\Models\TipoPerfil;

class ServicoService
{
    public function cadastrar(DadosCadastroServicoService $dadosCadastroServico)
    {
        $fotografo = Fotografo::findOrFail($dadosCadastroServico->fotografo);

        $servico = Servico::fromDadosCadastro($dadosCadastroServico);

        $servico->save();
    }

    public function atualizar(DadosAtualizacaoServico $dadosAtualizacao)
    {

    }

    public function verificarEnvolvimento(Servico $servico)
    {
        abort_if(!in_array(auth()->id(), [$servico->cliente_id, $servico->fotografo_id]), 403);

        return true;
    }

    public function verificarStatusCliente(string $status)
    {
        $statusCliente = Servico::STATUS_CLIENTE;
        $tipoPerfil = auth()->user()->tipoPerfil->nome;

        abort_if(
            ($tipoPerfil !== TipoPerfil::CLIENTE) ||
            !in_array(strtolower($status), $statusCliente), 
            403
        );

        return true;
    }

    public function verificarStatusFotografo(string $status)
    {
        $statusFotografo = Servico::STATUS_FOTOGRAFO;

        $tipoPerfil = auth()->user()->tipoPerfil->nome;

        abort_if(
            $tipoPerfil !== TipoPerfil::FOTOGRAFO ||
            !in_array(strtolower($status), $statusFotografo),
            403
        );

        return true;
    }
}
