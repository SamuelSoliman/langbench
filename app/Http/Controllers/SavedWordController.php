<?php

namespace App\Http\Controllers;

use App\Models\SavedWord;
use Illuminate\Http\Request;
use App\Http\Requests\SavedWordStoreRequest;
use App\Http\Requests\SavedWordUpdateRequest;
use App\Http\Resources\SavedWordResource;

class SavedWordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SavedWordResource::collection(SavedWord::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavedWordStoreRequest $request)
    {
        $validated = $request->validated();
        $savedWord = $request->user()->savedWords()->create($validated);

        return new SavedWordResource($savedWord);
    }

    /**
     * Display the specified resource.
     */
    public function show(SavedWord $savedWord)
    {
        return new SavedWordResource($savedWord);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavedWord $savedWord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavedWordUpdateRequest $request, SavedWord $savedWord)
    {
        $savedWord->update($request->validated());

        return new SavedWordResource($savedWord);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavedWord $savedWord)
    {
        $savedWord->delete();

        return response()->noContent();
    }
}
