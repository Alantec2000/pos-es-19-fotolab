<?php

namespace App\Services;

use App\DTOS\ConsultaFotografoFiltros;
use App\Models\Fotografo;

class FotografoService
{
    public function __construct(Fotografo $fotografo)
    {
        $this->fotografo = $fotografo ?? new Fotografo();
    }

    public function obterVarios(ConsultaFotografoFiltros $filtros)
    {
        return $this->fotografo->newQuery()
        ->when($filtros->id, function ($q, $id) {
            $q->whereId($id);
        })
        ->when($filtros->nome, function ($q, $nome) {
            $q->where('nome', 'like', "$nome%");
        })
        ->when($filtros->categorias, function ($q, $categorias) {
            $q->whereHas(
                'categorias', 
                function ($q) use ($categorias) {
                    $q->whereIn('id', $categorias);
                }
            );
        })->get();
    }
}
