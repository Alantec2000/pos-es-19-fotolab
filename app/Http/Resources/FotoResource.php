<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $portfolioPath = config('filesystems.disks.imgs_portfolio.relative_path'); 

        return [
            'id' => $this->id,
            'caminho' => "$portfolioPath/{$this->fotografo_id}/",
            'nome_arquivo' => "$this->nome_arquivo",
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'meta_data' => $this->meta_data
        ];
    }
}
