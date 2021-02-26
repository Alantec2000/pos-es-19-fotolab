<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarServicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data_inicio' => 'sometimes|string|date_format:d/m/Y H:i',
            'data_fim' => 'sometimes|string|date_format:d/m/Y H:i|after_or_equal:data_inicio',
            'titulo' => 'sometimes|string|max:80',
            'descricao' => 'sometimes|string|max:500',
        ];
    }
}
