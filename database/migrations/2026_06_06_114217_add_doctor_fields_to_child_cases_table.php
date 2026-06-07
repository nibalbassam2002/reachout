<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('child_cases', function (Blueprint $table) {
            $table->text('doctor_note')->nullable()->after('notes');
            $table->tinyInteger('doctor_rating')->nullable()->after('doctor_note');
        });
    }

    public function down(): void
    {
        Schema::table('child_cases', function (Blueprint $table) {
            $table->dropColumn(['doctor_note', 'doctor_rating']);
        });
    }
};