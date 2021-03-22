<?php

namespace App\Http\Controllers;

use App\DTOS\ConsultaFotografoFiltros;
use App\Http\Requests\ConsultaFotografosRequest;
use App\Models\Fotografo;
use App\Models\TipoPerfil;
use App\Services\FotografoService;

class FotografoController extends Controller
{
    public function index(ConsultaFotografosRequest $request)
    {
        return view('fotografo.index');
    }
    
    public function show(Fotografo $fotografo)
    {
        abort_if(
            !$fotografo || !$fotografo->temPerfilFotografo(),
            404,
            "Fotografo não encontrado!"
        );

        return view('fotografo.perfil', compact('fotografo'));
    }
}
