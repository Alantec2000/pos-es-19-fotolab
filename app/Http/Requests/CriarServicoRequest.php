<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CriarServicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fotografo' => 'required|integer|min:1',
            'data_inicio' => 'required|string|date_format:d/m/Y H:i',
            'data_fim' => 'required|string|date_format:d/m/Y H:i|after_or_equal:data_inicio',
            'titulo' => 'required|string|max:80',
            'descricao' => 'required|string|max:500',
        ];
    }
}
