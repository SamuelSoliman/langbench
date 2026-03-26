<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Http\Resources\QuizResource;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuizResource::collection(Quiz::all());
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
    public function store(QuizStoreRequest $request)
    {
        $validated = $request->validated();
        $quiz = $request->user()->quizzes()->create($validated);

        return new QuizResource($quiz);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return new QuizResource($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizUpdateRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return new QuizResource($quiz);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return response()->noContent();
    }
}
