<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donor_profile_id')
                  ->constrained('donor_profiles')
                  ->cascadeOnDelete();

            // decimal وليس float — للأموال دائماً
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');

            // *** التعديل الأول: نوع التبرع ***
            // one_time  ← تبرع مرة واحدة
            // monthly   ← اشتراك شهري متكرر
            $table->enum('subscription_type', [
                'one_time',
                'monthly'
            ])->default('one_time');

            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'refunded',
                'cancelled' // ← للاشتراك الشهري الذي أُلغي
            ])->default('pending');

            // بوابة الدفع المستخدمة
            $table->string('payment_gateway')->nullable(); // 'stripe', 'paypal'
            $table->string('payment_ref')->nullable()->unique();

            // *** التعديل الثاني: حقول الاشتراك الشهري ***
            // gateway_subscription_id: معرف الاشتراك عند Stripe/PayPal
            // مثال: sub_1234567890 عند Stripe
            $table->string('gateway_subscription_id')->nullable();

            // next_billing_at: موعد الدفعة الشهرية القادمة
            $table->timestamp('next_billing_at')->nullable();

            // cancelled_at: متى ألغى المتبرع اشتراكه؟
            $table->timestamp('cancelled_at')->nullable();

            $table->text('message')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'donated_at']);
            $table->index(['subscription_type', 'status']); // ← index جديد
            $table->index('next_billing_at'); // للـ cron job الشهري
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};