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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable();
            $table->string('work_title', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->string('status', 40)->default('active');
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
        Schema::dropIfExists('works');
    }
};
