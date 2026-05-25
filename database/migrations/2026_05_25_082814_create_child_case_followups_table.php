<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('child_case_followups', function (Blueprint $table) {
            $table->id();

            // FK للحالة الأصلية
            $table->foreignId('child_case_id')
                  ->constrained('child_cases')
                  ->cascadeOnDelete();

            // نص المتابعة الجديدة من ولي الأمر
            $table->text('note');

            // عبر أي قناة أُرسلت المتابعة
            $table->enum('sent_via', ['whatsapp', 'email']);

            $table->timestamps();

            $table->index(['child_case_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_case_followups');
    }
};