<?php

namespace App\DTOS;

use Spatie\DataTransferObject\DataTransferObject;

class CadastrarUsuario extends DataTransferObject
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var ?integer
     */
    public $tipo_perfil_id;

    /**
     * @var string
     */
    public $senha;

    /**
     * @var string
     */
    public $nome;

    /**
     * @var string
     */
    public $sobrenome;

    /**
     * @var string
     */
    public $data_nascimento;

    /**
     * @var ?Illuminate\Http\UploadedFile|Illuminate\Http\Testing\File
     */
    public $foto_perfil;

    /**
     * @var ?Illuminate\Http\UploadedFile|Illuminate\Http\Testing\File
     */
    public $foto_capa;

    /**
     * @var string
     */
    public $tipo;
}
