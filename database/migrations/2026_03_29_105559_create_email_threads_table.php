<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')
                  ->unique()
                  ->constrained('conversations')
                  ->cascadeOnDelete();
            $table->string('thread_id')->unique();
            $table->string('subject');
            $table->string('from_email');
            $table->string('to_email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_threads');
    }
};