<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacher extends FormRequest
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
            'name'          => 'required|string|min:5',
            'speciality'    => 'required|string|max:255',
            'years'         => 'required|numeric',
            'country'       => 'required|string|max:255',
            'phone'         => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{3})/',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Es necesario que ingrese el nombre del profesor',
            'name.string'  => 'El nombre debe contener caracteres',
            'name.min'  => 'El nombre de contener minimo 5 caracteres',
            'speciality.required' => 'Es necesario ingresar la especialdiad del profesor',
            'speciality.string'  => 'El nombre debe contener caracteres',
            'speciality.max'  => 'La especialidad debe contener maximo 255 caracteres',
            'years.required' => 'El tiempo de experiencia es requerido',
            'years.numeric'  => 'El tiempo de experiencia debe contener numeros',
            'country.required' => 'El pais es requerido',
            'country.string'  => 'El pais debe contener caracteres',
            'country.max'  => 'El pais debe contener maximo 255 caracteres',
            'phone.required'  => 'El telefono es requerido',
            'phone.regex'  => 'El telefono no tiene un formato valido',
        ];
    }

    public function validate() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            return response()->json($instance->messages(),200);
        }
    }
        
   
}
