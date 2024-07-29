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
        Schema::create('bo_authorizes', function (Blueprint $table) {
            $table->id();
            $table->integer('bo_id')->unique();
            $table->string('auth_courtesy_title', 250)->nullable();
            $table->string('auth_firstname', 250)->nullable();
            $table->string('auth_lastname', 250)->nullable();
            $table->string('auth_occupation', 250)->nullable();
            $table->timestamp('auth_date_of_birth')->nullable();
            $table->string('auth_nid', 250)->nullable();
            $table->string('auth_father_name', 250)->nullable();
            $table->string('auth_mother_name', 250)->nullable();
            $table->string('auth_address_line_1', 500)->nullable();
            $table->string('auth_address_line_2', 500)->nullable();
            $table->string('auth_address_line_3', 500)->nullable();
            $table->string('auth_city', 250)->nullable();
            $table->string('auth_post_code', 250)->nullable();
            $table->string('auth_division', 250)->nullable();
            $table->string('auth_country', 250)->nullable();
            $table->string('auth_email', 250)->nullable();
            $table->string('auth_mobile', 250)->nullable();
            $table->string('auth_telephone', 250)->nullable();
            $table->string('auth_fax', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_authorizes');
    }
};
