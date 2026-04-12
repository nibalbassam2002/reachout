<?php
// database/migrations/2024_01_01_000003_create_doctor_profiles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->unique()                // دكتور واحد = ملف واحد فقط
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('specialization');
            $table->text('bio')->nullable();
            $table->string('license_number')->nullable();
            $table->integer('years_experience')->default(0);
            $table->integer('max_cases')->default(10);
            $table->integer('current_cases')->default(0);
            $table->boolean('available')->default(true);
            $table->json('languages')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};