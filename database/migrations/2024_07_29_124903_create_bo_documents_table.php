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
        Schema::create('bo_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('bo_id')->unique();
            $table->string('first_applicant_1st_holder_photo', 250)->nullable();
            $table->string('first_applicant_1st_holder_NID_Passport_Driving_front_side', 250)->nullable();
            $table->string('first_applicant_1st_holder_NID_Passport_Driving_back_side', 250)->nullable();
            $table->string('signature_of_first_applicant', 250)->nullable();
            $table->string('TIN_certificate_of_first_applicant_1st_holder', 250)->nullable();
            $table->string('bank_statement_certificate_cheque_copy', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_documents');
    }
};
