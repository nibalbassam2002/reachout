<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();

            $table->foreignId('contact_id')
                  ->constrained('contacts')
                  ->cascadeOnDelete();

            $table->foreignId('assigned_doctor_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // *** التعديل الأول ***
            // handler_type: من يتولى هذه الحالة؟
            // doctor  ← رقم فلسطيني عادي
            // admin   ← رقم أجنبي أو حالة escalated
            $table->enum('handler_type', ['doctor', 'admin'])->default('doctor');

            $table->enum('status', [
                'new',
                'assigned',
                'in_progress',
                'pending',
                'resolved',
                'closed',
                'escalated'
            ])->default('new');

            $table->enum('channel', ['whatsapp', 'email']);

            $table->enum('priority', [
                'low', 'medium', 'high', 'crisis'
            ])->default('medium');

            $table->text('bot_summary')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('first_response_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            // *** التعديل الثاني ***
            // last_activity_at: يُحدَّث عند كل رسالة جديدة
            // يُستخدم لترتيب الحالات في داشبورد المشرف
            $table->timestamp('last_activity_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'priority']);
            $table->index(['assigned_doctor_id', 'status']);
            $table->index(['handler_type', 'status']); // ← index جديد
            $table->index('last_activity_at');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};