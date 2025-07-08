<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReporteConductaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','min:5', 'max:255'],
            'area' => ['required','string','min:5', 'max:255'],
            'message' => ['required','string','min:5', 'max:255'],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'El nombre del colaborador es obligatorio',
            'name.min' => 'El nombre del colaborador debe tener al menos 5 caracteres',
            'name.max' => 'El nombre del colaborador no puede superar los 255 caracteres',
            'area.required' => 'La área del colaborador es obligatoria',
            'area.min' => 'La área del colaborador debe tener al menos 5 caracteres',
            'area.max' => 'La área del colaborador no puede superar los 255 caracteres',
            'message.required' => 'El mensaje es obligatorio',
            'message.min' => 'El mensaje debe tener al menos 5 caracteres',
            'message.max' => 'El mensaje no puede superar los 255 caracteres',
        ];
    }
}
