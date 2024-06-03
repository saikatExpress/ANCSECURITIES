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
        Schema::create('form_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('form_file', 250)->nullable();
            $table->string('form_name', 250)->nullable();
            $table->string('form_title', 250)->nullable();
            $table->string('form_description', 550)->nullable();
            $table->string('created_by', 250)->nullable();
            $table->string('updated_by', 250)->nullable();
            $table->string('status', 20)->default('1')->nullable();
            $table->integer('flag')->default(0)->nullable();
            $table->integer('privacy')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_uploads');
    }
};
