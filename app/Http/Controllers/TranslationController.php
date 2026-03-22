<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationController extends Controller
{
    public function translate(TranslationRequest $request)
{
    $validated = $request->validated();

    $word = $validated['word'];
    $context = $validated['context_sentence'] ?? '';
    $targetLanguage = $validated['target_language'];

    $prompt = "
Translate the following word into {$targetLanguage}.

Word: {$word}
Context: {$context}

Return ONLY a valid JSON object in this exact format:
{
  \"translation\": \"...\",
  \"usage_note\": \"...\"
}
Do not add any explanation or extra text.
";

    $response = Http::withHeaders([
        'x-api-key' => config('services.anthropic.key'),
        'anthropic-version' => '2023-06-01',
    ])->post('https://api.anthropic.com/v1/messages', [
        'model' => 'claude-haiku-4-5-20251001',
        'max_tokens' => 200,
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt,
            ],
        ],
    ]);

    // Extract AI raw response
    $content = $response->json('content.0.text');

    // Clean + extract JSON safely
    $cleaned = trim($content);

    preg_match('/\{.*\}/s', $cleaned, $matches);

    $jsonString = $matches[0] ?? null;

    $parsed = $jsonString ? json_decode($jsonString, true) : null;

    if (!$parsed) {
        Log::error('Invalid AI response', ['raw' => $content]);

        return response()->json([
            'error' => 'Invalid AI response',
            'raw' => $content
        ], 500);
    }

    return response()->json($parsed);
}
}
