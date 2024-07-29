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
        Schema::create('b_o_forms', function (Blueprint $table) {
            $table->id();
            $table->string('bo_type', 50)->nullable();
            $table->string('type_of_client', 50)->nullable();
            $table->string('courtesy_title', 50)->nullable();
            $table->string('firstname', 250)->nullable();
            $table->string('lastname', 250)->nullable();
            $table->string('father_name', 250)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('gender', 25)->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('address_line_1', 300)->nullable();
            $table->string('address_line_2', 300)->nullable();
            $table->string('address_line_3', 300)->nullable();
            $table->string('city', 300)->nullable();
            $table->string('postal_code', 300)->nullable();
            $table->string('division', 300)->nullable();
            $table->string('country', 300)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('telephone', 300)->nullable();
            $table->string('fax', 300)->nullable();
            $table->string('nationality', 300)->nullable();
            $table->string('tin', 300)->nullable();
            $table->string('broker_branch', 300)->nullable();
            $table->string('residency', 300)->nullable();
            $table->string('email', 300)->nullable();
            $table->string('nid_no', 300)->nullable();
            $table->string('director_company', 300)->nullable();
            $table->string('joint_courtesy_title', 300)->nullable();
            $table->string('joint_firstname', 300)->nullable();
            $table->string('joint_lastname', 300)->nullable();
            $table->string('joint_occupation', 300)->nullable();
            $table->string('joint_date_of_birth', 300)->nullable();
            $table->string('joint_father_name', 300)->nullable();
            $table->string('joint_mother_name', 300)->nullable();
            $table->string('joint_nid', 300)->nullable();
            $table->string('joint_address_line_1', 300)->nullable();
            $table->string('joint_address_line_2', 300)->nullable();
            $table->string('joint_address_line_3', 300)->nullable();
            $table->string('joint_city', 300)->nullable();
            $table->string('joint_post_code', 300)->nullable();
            $table->string('joint_division', 300)->nullable();
            $table->string('joint_country', 300)->nullable();
            $table->string('joint_email', 300)->nullable();
            $table->string('joint_mobile', 300)->nullable();
            $table->string('joint_telephone', 300)->nullable();
            $table->string('joint_fax', 300)->nullable();
            $table->string('status', 40)->default('active');
            $table->integer('flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_o_forms');
    }
};
