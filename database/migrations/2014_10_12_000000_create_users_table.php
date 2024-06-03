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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('profile_image', 250)->nullable();
            $table->string('email', 250)->unique();
            $table->string('mobile', 25)->nullable();
            $table->string('whatsapp', 25)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('otp', 10)->nullable();
            $table->string('trading_code', 100)->nullable();
            $table->string('role', 25)->default('user')->nullable();
            $table->string('user_agent', 200)->nullable();
            $table->string('fb_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('twiter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 250);
            $table->string('status', 20)->default('active')->nullable();
            $table->integer('is_block')->default(0)->nullable();
            $table->integer('flag')->default(0)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
