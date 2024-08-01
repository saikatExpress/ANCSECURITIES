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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('branch_slug', 100)->nullable();
            $table->string('name', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->integer('department_id')->nullable();
            $table->foreignId('designation_id')->constrained('designations')
            ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('permanent_address', 250)->nullable();
            $table->string('present_address', 250)->nullable();
            $table->unsignedBigInteger('basic_salary')->nullable();
            $table->string('nid', 250)->nullable();
            $table->string('birth_certificate', 250)->nullable();
            $table->string('nationality', 25)->default('bangladeshi')->nullable();
            $table->integer('machine_id')->nullable();
            $table->string('status', 20)->default('1')->nullable();
            $table->integer('flag')->nullable();
            $table->string('staff_image', 250)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
