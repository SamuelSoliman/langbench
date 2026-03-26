<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
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
            'data' => 'sometimes|required|array',
            'score' => 'nullable|integer|min:0|max:100',
            'completed_at' => 'nullable|date',
        ];
    }
}