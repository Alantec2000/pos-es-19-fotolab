<?php


namespace App\DTOs;


use Spatie\DataTransferObject\DataTransferObject;

class DadosCadastroServicoService extends DataTransferObject
{
    /**
     * @var integer
     */
    public $fotografo;
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
