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
            $table->string('client_name', 250)->nullable();
            $table->string('father_name', 250)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('gender', 25)->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('city', 300)->nullable();
            $table->string('postal_code', 300)->nullable();
            $table->string('division', 300)->nullable();
            $table->string('country', 300)->nullable();
            $table->string('mobile', 300)->nullable();
            $table->string('email', 300)->nullable();
            $table->string('nid_no', 300)->nullable();
            $table->string('nid_attachment', 300)->nullable();
            $table->string('user_photo', 300)->nullable();
            $table->string('user_signature', 300)->nullable();
            $table->string('bank_name', 300)->nullable();
            $table->string('branch_name', 300)->nullable();
            $table->string('bank_account_no', 300)->nullable();
            $table->string('routing_number', 300)->nullable();
            $table->string('cheque_leaf', 300)->nullable();
            $table->string('nominee_name', 300)->nullable();
            $table->string('n_relationship', 300)->nullable();
            $table->string('percentage', 300)->nullable();
            $table->string('n_mobile', 300)->nullable();
            $table->string('n_nid', 300)->nullable();
            $table->string('n_nid_attachment', 300)->nullable();
            $table->string('n_photo', 300)->nullable();
            $table->string('n_signature', 300)->nullable();
            $table->string('j_name', 300)->nullable();
            $table->string('j_mobile', 300)->nullable();
            $table->string('j_nid_attachment', 300)->nullable();
            $table->string('j_signature', 300)->nullable();
            $table->string('j_gender', 300)->nullable();
            $table->string('j_nid', 300)->nullable();
            $table->string('j_photo', 300)->nullable();
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
