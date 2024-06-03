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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image', 250)->nullable();
            $table->string('banner_title', 250)->nullable();
            $table->string('short_title', 250)->nullable();
            $table->text('short_description')->nullable();
            $table->string('created_by', 250)->nullable();
            $table->string('updated_by', 250)->nullable();
            $table->string('status', 20)->default('1')->nullable();
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
        Schema::dropIfExists('banners');
    }
};
