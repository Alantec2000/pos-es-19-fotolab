<?php

namespace App\Http\Controllers\Api;

use App\DTOS\ConsultaFotografoFiltros;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultaFotografosRequest;
use App\Http\Resources\FotografoResource;
use App\Services\FotografoService;
use Illuminate\Http\Request;

class FotografoController extends Controller
{
    /**
     * @var FotografoServico
     */
    private $fotografoService;

    public function __construct(FotografoService $fotografoService)
    {
        $this->fotografoService = $fotografoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConsultaFotografosRequest $request)
    {
        $parametros = new ConsultaFotografoFiltros($request->validated());
        
        $fotografos = $this->fotografoService->obterVarios($parametros);

        return FotografoResource::collection($fotografos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
