<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')
                  ->constrained('cases')
                  ->cascadeOnDelete();
            $table->enum('channel', ['whatsapp', 'email']);
            $table->timestamp('last_message_at')->nullable();

            // عدد الرسائل التي لم يقرأها الدكتور
            $table->integer('unread_count')->default(0);

            // *** التعديل ***
            // عدد الرسائل التي لم يقرأها المشرف
            $table->integer('admin_unread_count')->default(0);

            $table->timestamp('started_at')->nullable();
            $table->timestamps();

            $table->index(['case_id', 'last_message_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};