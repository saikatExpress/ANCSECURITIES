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
        Schema::create('d_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('dp_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('employee_name', 250)->nullable();
            $table->string('employee_designation', 50)->nullable();
            $table->string('website_link', 250)->nullable();
            $table->string('status', 50)->default('1');
            $table->integer('flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_p_s');
    }
};
