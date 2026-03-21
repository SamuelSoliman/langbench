<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_words', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('text_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('word');
            $table->string('translation');
            $table->text('context_sentence')->nullable();

            $table->timestamps();
        });


        DB::statement("
            ALTER TABLE saved_words
            ADD COLUMN search_vector tsvector
            GENERATED ALWAYS AS (
                to_tsvector('simple', word || ' ' || translation)
            ) STORED
        ");


        DB::statement("
            CREATE INDEX saved_words_search_vector_idx
            ON saved_words
            USING GIN (search_vector)
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_words');
    }
};
