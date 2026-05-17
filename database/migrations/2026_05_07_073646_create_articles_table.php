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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // فريد لعدم تكرار نفس الخبر
            $table->text('description')->nullable();
            $table->text('url')->nullable(); // الرابط الأصلي قد يكون طويلاً أحياناً
            $table->text('image_url')->nullable();
            $table->string('source')->nullable(); // اسم الموقع المصدر
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
