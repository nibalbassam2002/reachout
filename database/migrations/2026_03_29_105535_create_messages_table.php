<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')
                  ->constrained('conversations')
                  ->cascadeOnDelete();

            $table->enum('sender_type', ['contact', 'doctor', 'bot', 'admin']);
            // *** إضافة 'admin' ← المشرف يرد مباشرة ***

            $table->unsignedBigInteger('sender_id')->nullable();

            $table->text('body');
            $table->enum('type', ['text','image','document','audio'])->default('text');
            $table->string('external_id')->nullable();

            $table->enum('status', [
                'sent', 'delivered', 'read', 'failed'
            ])->default('sent');

            $table->boolean('is_flagged')->default(false);

            // *** التعديل ***
            // متى قرأ المشرف هذه الرسالة؟
            $table->timestamp('read_by_admin_at')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['conversation_id', 'sent_at']);
            $table->index('is_flagged');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};