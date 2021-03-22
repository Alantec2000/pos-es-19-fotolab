<?php

namespace App\DTOS;

use Spatie\DataTransferObject\DataTransferObject;

class ConsultaFotografoFiltros extends DataTransferObject
{
    public $id;
    public $nome;
    public $sobrenome;
    public $categorias = [];
}
