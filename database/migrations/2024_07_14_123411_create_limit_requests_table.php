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
        Schema::create('limit_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('trade_id')->nullable();
            $table->string('client_name', 250)->nullable();
            $table->unsignedBigInteger('limit_amount')->nullable();
            $table->string('reason', 500)->nullable();
            $table->string('approved_by', 250)->nullable();
            $table->string('declined_by', 250)->nullable();
            $table->string('status', 150)->default('pending');
            $table->integer('flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limit_requests');
    }
};
