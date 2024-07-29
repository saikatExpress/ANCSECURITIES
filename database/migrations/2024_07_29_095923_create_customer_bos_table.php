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
        Schema::create('customer_bos', function (Blueprint $table) {
            $table->id();
            $table->integer('bo_id')->unique();
            $table->integer('bank_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('bank_district_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_bos');
    }
};
