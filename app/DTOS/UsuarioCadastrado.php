<?php

namespace App\DTOS;

use Spatie\DataTransferObject\DataTransferObject;

class UsuarioCadastrado extends DataTransferObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $nome_usuario;
}
