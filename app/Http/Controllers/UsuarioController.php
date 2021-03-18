<?php

namespace App\Http\Controllers;

use App\DTOS\CadastrarUsuario;
use App\Http\Requests\CadastrarUsuarioRequest;
use App\Services\TipoPerfilService;
use App\Services\UsuarioService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Throwable;

class UsuarioController extends Controller
{
    /**
     * @var UsuarioService
     */
    private $usuarioService;

    /**
     * @var TipoPerfilService
     */
    private $tipoPerfilService;

    public function __construct(UsuarioService $usuarioService, TipoPerfilService $tipoPerfilService)
    {
        $this->usuarioService = $usuarioService;
        $this->tipoPerfilService = $tipoPerfilService;
    }

    /**
     * Rota principal do formulário de cadastro
     *
     * @return Application|Factory|View
     */
    public function formulario()
    {
        return view('usuario.cadastro.formulario');
    }

    /**
     * Rota de cadastro do usuário. Cria um novo usuário no
     * banco de dados de acordo com os dados informados.
     *
     * Redireciona para o formulário novamente em caso de erro.
     *
     * @param CadastrarUsuarioRequest $request
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function criar(CadastrarUsuarioRequest $request)
    {
        try {
            $cadastrarUsuarioObject = new CadastrarUsuario($request->validated());

            $tipoPerfil = $this->tipoPerfilService->obterPeloNome($cadastrarUsuarioObject->tipo);
            $this->usuarioService->verificarEmailUnico($cadastrarUsuarioObject->email);

            $cadastrarUsuarioObject->tipo_perfil_id = $tipoPerfil->id;
            $usuario = $this->usuarioService->cadastrarNovoUsuario($cadastrarUsuarioObject);
        } catch (Throwable $e) {
            return redirect(route('cadastro'))->withErrors([
                'generalError' => $e->getMessage()
            ]);
        }

        return view('usuario.cadastro.sucesso', $usuario->toArray());
    }

    public function listarUsuarios()
    {
        return [];
    }

    public function listarClientes()
    {
        return [];
    }

    public function listarFotografos()
    {
        return [];
    }
}
