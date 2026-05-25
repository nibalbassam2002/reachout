<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique(); // هاتف أو إيميل
            $table->enum('channel', ['whatsapp', 'email']);
            $table->string('display_name')->nullable();       // اسم ولي الأمر
            $table->string('guardian_relation', 50)->nullable(); // ← جديد: أب/أم/عم...
            $table->string('age_range')->nullable();
            $table->string('gender')->nullable();
            $table->string('country_code', 5)->nullable();
            $table->boolean('is_blocked')->default(false);
            $table->timestamp('first_contact_at')->nullable();
            $table->timestamp('last_contact_at')->nullable();
            $table->timestamps();

            $table->index(['channel', 'is_blocked']);
            $table->index('country_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};