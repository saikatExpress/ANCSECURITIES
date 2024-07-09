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
            $table->unsignedBigInteger('bo_id')->unique()->nullable();
            $table->string('name', 250)->nullable();
            $table->string('ac_type', 100)->nullable();
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
