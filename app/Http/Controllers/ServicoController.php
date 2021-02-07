<?php

namespace App\Http\Controllers;

use App\DTOs\DadosCadastroServicoService;
use App\Http\Requests\CriarServicoRequest;
use App\Services\FotografoService;

class ServicoController extends Controller
{
    /**
     * @var FotografoService
     */
    private $fotografoService;

    public function __construct(FotografoService $fotografoService)
    {
        $this->fotografoService = $fotografoService;
    }

    public function index()
    {

    }

    public function create(CriarServicoRequest $request)
    {
        $dadosCadastroServico = new DadosCadastroServicoService($request->validated());

        $this->fotografoService->cadastrarNovoServico($dadosCadastroServico);

        return view('fotografo.servico.novo.sucesso');
    }
}
