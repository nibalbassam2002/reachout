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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('bank_name');
            $table->string('swift_code');
            $table->string('branch');
            $table->string('country')->default('Palestine 🇵🇸');
            $table->string('city')->default('Gaza');
            $table->string('iban_usd');
            $table->string('iban_ils');
            $table->string('whatsapp_number'); // لإضافة رقم الواتساب ديناميكياً
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
