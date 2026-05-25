<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('child_cases', function (Blueprint $table) {
            $table->id();

            // الرقم المرجعي الفريد — MHF-2025-00189
            $table->string('case_number', 50)->unique();

            // ولي الأمر
            $table->foreignId('contact_id')
                  ->constrained('contacts')
                  ->cascadeOnDelete();

            // قناة التواصل
            $table->enum('channel', ['whatsapp', 'email']);

            // ── بيانات الطفل ──────────────────────
            $table->string('child_name');
            $table->tinyInteger('child_age')->unsigned();
            $table->string('child_grade', 50)->nullable();
            $table->enum('child_gender', ['male', 'female', 'prefer_not']);

            // ── تفاصيل الحالة ─────────────────────
            $table->json('symptoms');                          // ["anxiety","sleep"]
            $table->string('extra_symptom')->nullable();       // عرض إضافي
            $table->enum('impact_level', ['1', '2', '3']);    // 1=Mild 2=Noticeable 3=Severe
            $table->text('notes');                             // الوصف التفصيلي

            // ── الإدارة ───────────────────────────
            $table->enum('priority', ['low', 'medium', 'high', 'crisis'])->default('medium');
            $table->enum('status', ['new', 'assigned', 'in_progress', 'resolved'])->default('new');
            $table->unsignedBigInteger('assigned_doctor_id')->nullable();

            $table->text('contact_url')->nullable();

            $table->timestamps();

            // Indexes للداشبورد
            $table->index('status');
            $table->index('channel');
            $table->index('priority');
            $table->index('impact_level');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_cases');
    }
};