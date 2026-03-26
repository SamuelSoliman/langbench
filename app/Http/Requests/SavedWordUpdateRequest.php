<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavedWordUpdateRequest extends FormRequest
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
            'text_id' => 'sometimes|required|exists:texts,id',
            'word' => 'sometimes|required|string|max:255',
            'translation' => 'sometimes|required|string|max:255',
            'context_sentence' => 'nullable|string',
        ];
    }
}