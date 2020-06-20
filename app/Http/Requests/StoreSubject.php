<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubject extends FormRequest
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
            'name'           => 'required|string|min:5',
            'description'    => 'required|string|max:255',
            'image'          => 'image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Es necesario que ingrese el nombre del profesor',
            'name.string'  => 'El nombre debe contener caracteres',
            'name.min'  => 'El nombre de contener minimo 5 caracteres',
            'description.required' => 'Es necesario ingresar la especialdiad del profesor',
            'description.string'  => 'El nombre debe contener caracteres',
            'description.max'  => 'La especialidad debe contener maximo 255 caracteres',
            'image.image'  => 'La imagen no tiene un formato valido',
        ];
    }
}
