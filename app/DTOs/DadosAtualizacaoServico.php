<?php


namespace App\DTOs;


use Spatie\DataTransferObject\DataTransferObject;

class DadosAtualizacaoServico extends DataTransferObject
{
    const ONLY_KEYS = ['data_inicio', 'data_fim', 'titulo', 'descricao'];

    /**
     * @var string
     */
    public $data_inicio;

    /**
     * @var string
     */
    public $data_fim;

    /**
     * @var string
     */
    public $titulo;

    /**
     * @var string
     */
    public $descricao;
}
