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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('subject', 500)->nullable();
            $table->string('message', 2000)->nullable();
            $table->unsignedBigInteger('is_rcv')->default(0)->nullable();
            $table->unsignedBigInteger('is_reply')->default(0)->nullable();
            $table->string('replied_by', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
