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
        Schema::create('bo_nominee_twos', function (Blueprint $table) {
            $table->id();
            $table->integer('bo_id')->unique();
            $table->integer('nominee_id')->unique();
            $table->string('nominee_2_courtesy_title', 250)->nullable();
            $table->string('nominee_2_firstname', 250)->nullable();
            $table->string('nominee_2_lastname', 250)->nullable();
            $table->string('nominee_2_relationship', 250)->nullable();
            $table->string('nominee_2_percentage', 250)->nullable();
            $table->string('nominee_2_residency', 250)->nullable();
            $table->timestamp('nominee_2_date_of_birth')->nullable();
            $table->string('nominee_2_nid', 250)->nullable();
            $table->string('nominee_2_address_line_1', 550)->nullable();
            $table->string('nominee_2_address_line_2', 550)->nullable();
            $table->string('nominee_2_address_line_3', 550)->nullable();
            $table->string('nominee_2_city', 50)->nullable();
            $table->string('nominee_2_post_code', 50)->nullable();
            $table->string('nominee_2_division', 50)->nullable();
            $table->string('nominee_2_country', 50)->nullable();
            $table->string('nominee_2_email', 250)->nullable();
            $table->string('nominee_2_mobile', 25)->nullable();
            $table->string('nominee_2_telephone', 25)->nullable();
            $table->string('nominee_2_fax', 25)->nullable();
            $table->string('guardian_of_nominee_2_courtesy_title', 25)->nullable();
            $table->string('guardian_of_nominee_2_firstname', 250)->nullable();
            $table->string('guardian_of_nominee_2_lastname', 250)->nullable();
            $table->string('guardian_of_nominee_2_relationship', 250)->nullable();
            $table->timestamp('guardian_of_nominee_2_maturity_date_of_minor')->nullable();
            $table->string('guardian_of_nominee_2_residency', 250)->nullable();
            $table->timestamp('guardian_of_nominee_2_date_of_birth')->nullable();
            $table->string('guardian_of_nominee_2_nid', 250)->nullable();
            $table->string('guardian_of_nominee_2_address_line_1', 500)->nullable();
            $table->string('guardian_of_nominee_2_address_line_2', 500)->nullable();
            $table->string('guardian_of_nominee_2_address_line_3', 500)->nullable();
            $table->string('guardian_of_nominee_2_city', 25)->nullable();
            $table->string('guardian_of_nominee_2_post_code', 25)->nullable();
            $table->string('guardian_of_nominee_2_division', 25)->nullable();
            $table->string('guardian_of_nominee_2_country', 25)->nullable();
            $table->string('guardian_of_nominee_2_email', 250)->nullable();
            $table->string('guardian_of_nominee_2_mobile', 25)->nullable();
            $table->string('guardian_of_nominee_2_telephone', 25)->nullable();
            $table->string('guardian_of_nominee_2_fax', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_nominee_twos');
    }
};
