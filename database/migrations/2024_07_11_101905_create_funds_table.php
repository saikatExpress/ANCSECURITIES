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
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('client_name', 250)->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('ac_no',100)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('feedback', 500)->nullable();
            $table->string('category', 100)->nullable();
            $table->timestamp('withdraw_date')->nullable();
            $table->string('remark', 250)->nullable();
            $table->unsignedInteger('complete_by')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->unsignedInteger('declined_by')->nullable();
            $table->string('status', 50)->default('pending');
            $table->integer('flag')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
