<?php

namespace App\Services;

use App\Models\TipoPerfil;

class TipoPerfilService
{
    public function obterPeloNome(string $nome)
    {
        $tipoPerfil = TipoPerfil::whereNome(ucfirst($nome))->first();

        throw_if(
            !$tipoPerfil,
            trans(
                'CadastroUsuario.tipo_perfil.nao_encontrado',
                [
                    'tipo' => $nome
                ]
            )
        );

        return $tipoPerfil;
    }
}

