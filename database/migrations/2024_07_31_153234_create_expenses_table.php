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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('staff_id')->nullable();
            $table->timestamp('expense_date')->nullable();
            $table->string('expense_head', 250)->nullable();
            $table->string('amount', 250)->nullable();
            $table->string('expense_category', 250)->nullable();
            $table->string('description', 550)->nullable();
            $table->string('receipt_image', 250)->nullable();
            $table->integer('assign_to_md')->nullable();
            $table->integer('assign_to_ceo')->nullable();
            $table->integer('assign_to_hr')->nullable();
            $table->string('status', 100)->default('pending');
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
        Schema::dropIfExists('expenses');
    }
};
