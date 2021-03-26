<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdicionarFotosRequest extends FormRequest
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
            'fotos' => 'required|array',
            'fotos.*' => 'file|mimes:png,jpg,jpeg'
        ];
    }
}
