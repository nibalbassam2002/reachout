<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')
                  ->constrained('contacts')
                  ->cascadeOnDelete();
            $table->string('wa_id')->unique();
            $table->enum('bot_state', [
                'greeting',
                'asking_name',
                'asking_age',
                'asking_gender',
                'asking_problem',
                'asking_country',
                'completed',
                'transferred',      // حُوِّل لدكتور
                'transferred_admin',// ← الجديد: حُوِّل للمشرف (رقم أجنبي)
                'waiting'
            ])->default('greeting');
            $table->json('collected_data')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_sessions');
    }
};