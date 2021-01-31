<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastrarUsuarioRequest;
use App\Models\TipoPerfil;
use App\Models\Usuario;
use App\Support\Factory\UserFactory;
use Exception;
use Throwable;

class UsuarioController extends Controller
{
    public function formulario()
    {
        return view('usuario.cadastro.formulario');
    }

    public function criar(CadastrarUsuarioRequest $request)
    {
        try {
            $dadosUsuario = $request->validated();
            
            $tipoPerfil = TipoPerfil::make()->fromNome($dadosUsuario['tipo']);

            $usuarioMesmoEmail = Usuario::whereEmail($dadosUsuario['email'])->first();
            throw_if($usuarioMesmoEmail, trans('CadastroUsuario.email.duplicado'));

            $usuario = Usuario::make($dadosUsuario);
            $usuario->senha = $dadosUsuario['senha'];
            $usuario->id_tipo_perfil = $tipoPerfil->id;
            $usuario->data_nascimento = date('Y-m-d', strtotime($dadosUsuario['data_nascimento']));
            
            if (!empty($dadosUsuario['foto_perfil'])) {
                $usuario->definirUrlFotoPerfil($dadosUsuario['foto_perfil']);
            }
            
            if (!empty($dadosUsuario['foto_capa']) && $tipoPerfil->nome === 'Fotografo') {
                $usuario->definirUrlFotoCapa($dadosUsuario['foto_capa']);
            }

            $usuario->save();
        } catch (Throwable $e) {
            return redirect(route('usuario.cadastro'))->withErrors([
                'generalError' => $e->getMessage()
            ]);
        }

        return view('usuario.cadastro.sucesso')
            ->with('id', $usuario->id)
            ->with('nome_usuario', $usuario->nome);
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
