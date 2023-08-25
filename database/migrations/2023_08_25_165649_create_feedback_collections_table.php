<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_form_id');
            $table->foreignId('user_id');
            $table->foreignId('feedback_question_id');
            $table->text('answer')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_collections');
    }
};
