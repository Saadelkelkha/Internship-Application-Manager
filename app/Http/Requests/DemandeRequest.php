<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            'etablissement' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'type_stage' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'competences' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'lettre_motivation' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:12048',
            'lettre_de_recommandation' => 'required|file|mimes:pdf|max:12048',
        ];
    }
}
