<?php

namespace App\Services;

use App\DTOS\CadastrarUsuario;
use App\DTOS\UsuarioCadastrado;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsuarioService
{
    /**
     * Valida se um e-mail é único ou não.
     *
     * @param string $email
     *
     * @throws Throwable
     *
     * @return void
     */
    public function verificarEmailUnico(string $email)
    {
        $usuarioMesmoEmail = Usuario::whereEmail($email)->first();
        throw_if($usuarioMesmoEmail, trans('CadastroUsuario.email.duplicado'));
    }

    /**
     * Cria um novo usuário de acordo com os parâmetros informados.
     * Cria a foto de capa somente se for um fotografo.
     *
     * @param CadastrarUsuario $cadastrarUsuario
     *
     * @return UsuarioCadastrado
     */
    public function cadastrarNovoUsuario(CadastrarUsuario $cadastrarUsuario): UsuarioCadastrado
    {
        $usuario = Usuario::make($cadastrarUsuario->toArray());
        $usuario->senha = Hash::make($cadastrarUsuario->senha);

        if (!empty($cadastrarUsuario->foto_perfil)) {
            $usuario->definirUrlFotoPerfil($cadastrarUsuario->foto_perfil);
        }

        $usuario->load('tipoPerfil');
        if (!empty($cadastrarUsuario->foto_capa) && $usuario->tipoPerfil->nome === 'Fotografo') {
            $usuario->definirUrlFotoCapa($cadastrarUsuario->foto_capa);
        }

        $usuario->save();

        return new UsuarioCadastrado([
            'id' => $usuario->id,
            'nome_usuario' => $usuario->nome
        ]);
    }
}
