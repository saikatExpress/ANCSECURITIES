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
        Schema::create('bo_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bo_id', 250)->nullable();
            $table->string('name', 250)->nullable();
            $table->string('ac_type', 100)->nullable();
            $table->string('father_name', 250)->nullable();
            $table->string('spouse_name', 250)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('address', 550)->nullable();
            $table->string('cell_no', 100)->nullable();
            $table->string('email', 250)->nullable();
            $table->timestamp('ac_open_date')->nullable();
            $table->string('bank_account_no', 250)->nullable();
            $table->string('bank_name', 250)->nullable();
            $table->string('branch_name', 250)->nullable();
            $table->string('trader_code', 250)->nullable();
            $table->string('status', 10)->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_accounts');
    }
};
