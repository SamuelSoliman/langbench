<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;
use App\Http\Requests\TextStoreRequest;
use App\Http\Requests\TextUpdateRequest;
use App\Http\Resources\TextResource;

class TextController extends Controller
{
    public function index()
    {
        return TextResource::collection(Text::all());
    }

    public function store(TextStoreRequest $request)
    {
        $validated = $request->validated();
        $text = $request->user()->texts()->create($validated);

        return new TextResource($text);
    }

    public function show(Text $text)
    {

        return new TextResource($text);
    }

    public function update(TextUpdateRequest $request, Text $text)
    {
       

        $text->update($request->validated());

        return new TextResource($text);
    }

    public function destroy(Text $text)
    {
        $text->delete();

        return response()->noContent();
    }
}

