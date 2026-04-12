<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phone_filters', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'blocked_number',    // رقم محدد محظور تماماً
                'blocked_country',   // دولة محظورة تماماً
                'allowed_country',   // فقط هذه الدول للدكاترة (فلسطين +970)
                'redirect_to_admin', // ← الجديد: أرقام أجنبية تذهب للمشرف
                'spam_keyword'       // كلمات سبام تُحظر
            ]);

            // value: رقم هاتف كامل، أو كود دولة مثل '+970' أو '+1'
            $table->string('value');

            $table->string('reason')->nullable();

            // من أضاف هذا الفلتر؟
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phone_filters');
    }
};