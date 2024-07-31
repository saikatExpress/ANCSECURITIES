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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('product_head', 250)->nullable();
            $table->string('product_type', 250)->nullable();
            $table->string('product_model', 250)->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('status', 50)->default('active');
            $table->unsignedInteger('added_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
