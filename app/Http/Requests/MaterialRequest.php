<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors(),
        ], 422));
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|unique:materiais,nome|string|max:125',
            'unidade_medida' => 'in:kg,unidade',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Campo nome é obrigatório!',
            'nome.unique' => 'Nome de material já cadastrado!',
            'nome.max' => 'Máximo de :max caracteres.',
            'unidade_medida.in' => 'A unidade de medida deve ser "kg" ou "unidade".',
        ];
    }
}
