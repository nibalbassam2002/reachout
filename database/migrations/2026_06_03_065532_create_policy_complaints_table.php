<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('contact_info');                // Name or Email
            $table->string('type_of_concern');             // Subject
            $table->text('details');                       // Description
            $table->enum('status', ['new', 'reviewed', 'resolved'])->default('new');
            $table->boolean('is_read')->default(false);    
            $table->string('ip_address', 45)->nullable();  // للأمان
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_complaints');
    }
};