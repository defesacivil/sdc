<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRoleRequest extends FormRequest
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
            'name'  => 'required|min:4|max:10',
            'label' => 'required|min:10|max:100', 
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'  => 'O campo : Nome é obrigatorio !',
            'name.min'  => 'O campo : Nome deve ter no mínimo 4 caracteres !',
            'name.max'  => 'O campo : Nome deve ter no máximo 10 caracteres !',
            'label.required' => 'O campo : Label é Obrigatorio !',
            'label.max' => 'O campo : Label deve ter no máximo 100 caracteres !',
            'label.min' => 'O campo : Label deve ter no mínimo 10 !',
        ];
    }
   
}
