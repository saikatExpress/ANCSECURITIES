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
        Schema::create('bo_nominees', function (Blueprint $table) {
            $table->id();
            $table->integer('bo_id')->unique();
            $table->string('nominee_1_courtesy_title', 20)->nullable();
            $table->string('nominee_1_firstname', 250)->nullable();
            $table->string('nominee_1_lastname', 250)->nullable();
            $table->string('nominee_1_relationship', 250)->nullable();
            $table->string('nominee_1_percentage', 250)->nullable();
            $table->string('nominee_1_residency', 250)->nullable();
            $table->timestamp('nominee_1_date_of_birth')->nullable();
            $table->string('nominee_1_nid', 250)->nullable();
            $table->string('nominee_1_address_line_1', 500)->nullable();
            $table->string('nominee_1_address_line_2', 500)->nullable();
            $table->string('nominee_1_address_line_3', 500)->nullable();
            $table->string('nominee_1_city', 250)->nullable();
            $table->string('nominee_1_post_code', 250)->nullable();
            $table->string('nominee_1_division', 250)->nullable();
            $table->string('nominee_1_country', 25)->nullable();
            $table->string('nominee_1_email', 250)->nullable();
            $table->string('nominee_1_mobile', 25)->nullable();
            $table->string('nominee_1_telephone', 55)->nullable();
            $table->string('nominee_1_fax', 55)->nullable();
            $table->string('guardian_of_nominee_1_courtesy_title', 55)->nullable();
            $table->string('guardian_of_nominee_1_firstname', 255)->nullable();
            $table->string('guardian_of_nominee_1_lastname', 255)->nullable();
            $table->string('guardian_of_nominee_1_relationship', 255)->nullable();
            $table->timestamp('guardian_of_nominee_1_maturity_date_of_minor')->nullable();
            $table->string('guardian_of_nominee_1_residency', 255)->nullable();
            $table->timestamp('guardian_of_nominee_1_date_of_birth')->nullable();
            $table->string('guardian_of_nominee_1_nid', 255)->nullable();
            $table->string('guardian_of_nominee_1_address_line_1', 550)->nullable();
            $table->string('guardian_of_nominee_1_address_line_2', 550)->nullable();
            $table->string('guardian_of_nominee_1_address_line_3', 550)->nullable();
            $table->string('guardian_of_nominee_1_city', 55)->nullable();
            $table->string('guardian_of_nominee_1_post_code', 55)->nullable();
            $table->string('guardian_of_nominee_1_division', 55)->nullable();
            $table->string('guardian_of_nominee_1_country', 155)->nullable();
            $table->string('guardian_of_nominee_1_email', 255)->nullable();
            $table->string('guardian_of_nominee_1_mobile', 25)->nullable();
            $table->string('guardian_of_nominee_1_telephone', 25)->nullable();
            $table->string('guardian_of_nominee_1_fax', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_nominees');
    }
};
