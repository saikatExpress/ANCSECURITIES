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
        Schema::create('news_portals', function (Blueprint $table) {
            $table->id();
            $table->integer('category')->nullable();
            $table->string('news_title', 500)->nullable();
            $table->string('quotes', 1500)->nullable();
            $table->longText('description')->nullable();
            $table->string('news_image', 250)->nullable();
            $table->string('tags', 350)->nullable();
            $table->string('created_by', 250)->nullable();
            $table->string('updated_by', 250)->nullable();
            $table->integer('is_view')->nullable();
            $table->integer('is_read')->nullable();
            $table->timestamp('news_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_portals');
    }
};
