<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavedWordStoreRequest extends FormRequest
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
            'text_id' => 'required|exists:texts,id',
            'word' => 'required|string|max:255',
            'translation' => 'required|string|max:255',
            'context_sentence' => 'nullable|string',
        ];
    }
}