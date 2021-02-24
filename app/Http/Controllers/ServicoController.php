<?php

namespace App\Http\Controllers;

use App\DTOs\DadosAtualizacaoServico;
use App\DTOs\DadosCadastroServicoService;
use App\Http\Requests\AtualizarServicoRequest;
use App\Http\Requests\CriarServicoRequest;
use App\Models\Servico;
use App\Services\ServicoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServicoController extends Controller
{
    /**
     * @var ServicoService
     */
    private $servicoService;

    public function __construct(ServicoService $servicoService)
    {
        $this->servicoService = $servicoService;
    }

    public function index()
    {
        if (auth()->user()->tipoPerfil->tipo_perfil === 'Fotografo') {
            return view('servico.index.fotografo');
        } else {
            return view('servico.index.cliente');
        }
    }

    public function create()
    {
        return view('servico.create');
    }

    public function store(CriarServicoRequest $request)
    {
        $dadosCadastroServico = new DadosCadastroServicoService($request->validated());

        $this->servicoService->cadastrar($dadosCadastroServico);

        return view('servico.novo.sucesso');
    }

    public function edit(Servico $servico)
    {
        return view('servico.edit', $servico);
    }

    /**
     * Permite um Cliente atualizar informações básicas do serviço.
     * O cliente pode editar: data de início e fim do serviço, seu título e descrição.
     *
     * @param AtualizarServicoRequest $request
     * @param Servico $servico
     *
     * @return Application|Factory|View
     */
    public function update(AtualizarServicoRequest $request, Servico $servico)
    {
        $this->servicoService->verificarEnvolvimento($servico);

        $dadosCadastroServico = new DadosAtualizacaoServico($request->validated());

        $servico->fill($dadosCadastroServico->toArray())->save();

        return redirect(route('servico.index'));
    }

    /**
     * Permite um Fotógrafo atualizar o status de um serviço
     *
     * @param Servico $servico
     * @param string $status
     *
     * @return RedirectResponse
     */
    public function atualizarStatusFotografo(Servico $servico, string $status)
    {
        $this->servicoService->verificarEnvolvimento($servico);

        $this->servicoService->verificarStatusFotografo($status);

        $servico->status = $status;

        $servico->save();

        return redirect(route('servico.index'));
    }

    /**
     * Permite um Fotógrafo atualizar o status de um serviço
     *
     * @param Servico $servico
     * @param string $status
     *
     * @return RedirectResponse
     */
    public function atualizarStatusCliente(Servico $servico, string $status)
    {
        $this->servicoService->verificarEnvolvimento($servico);

        $this->servicoService->verificarStatusCliente($status);

        $servico->status = $status;

        $servico->save();

        return redirect(route('servico.index'));
    }
}
