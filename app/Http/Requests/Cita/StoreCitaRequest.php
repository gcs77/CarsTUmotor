<?php

namespace App\Http\Requests\Cita;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_hora' => ['required', 'date', 'after:now'],
            'motivo' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_hora.required' => 'La fecha y hora son obligatorias.',
            'fecha_hora.after' => 'La cita debe programarse para una fecha futura.',
            'motivo.required' => 'El motivo de la cita es obligatorio.',
            'motivo.min' => 'El motivo debe tener al menos 10 caracteres.',
            'motivo.max' => 'El motivo no puede superar los 500 caracteres.',
        ];
    }
}
