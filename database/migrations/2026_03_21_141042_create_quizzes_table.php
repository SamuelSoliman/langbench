<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('text_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->integer('score')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });


        DB::statement("
            ALTER TABLE quizzes
            ADD COLUMN data JSONB
        ");

        
        DB::statement("
            CREATE INDEX quizzes_data_gin_idx
            ON quizzes
            USING GIN (data)
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
