<?php
// database/migrations/2024_01_01_000006_create_contacts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->enum('channel', ['whatsapp', 'email']);
            $table->string('display_name')->nullable();
            $table->string('age_range')->nullable();  // "18-25" بدل العمر الدقيق
            $table->string('gender')->nullable();
            $table->string('country_code', 5)->nullable(); // "+970"

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