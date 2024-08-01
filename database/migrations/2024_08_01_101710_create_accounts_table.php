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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->decimal('balance', 15, 2);
            $table->string('account_number', 50)->unique();
            $table->string('bank_name', 250)->nullable();
            $table->string('branch_name', 250)->nullable();
            $table->string('ifsc_code', 50)->nullable();
            $table->enum('account_type', ['savings', 'current', 'fixed_deposit', 'recurring_deposit', 'loan', 'nre', 'nro'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
