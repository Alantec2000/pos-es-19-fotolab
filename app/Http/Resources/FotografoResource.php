<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FotografoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url_foto_perfil' => $this->url_foto_perfil,
            'url_foto_capa' => $this->url_foto_capa,
            'data_nascimento' => $this->data_nascimento,
            'data_cadastro' => $this->created_at,
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email' => $this->email,
            'categorias' => $this->categorias ?? []
        ];
    }
}
