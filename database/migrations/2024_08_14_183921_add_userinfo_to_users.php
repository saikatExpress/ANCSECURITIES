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
        Schema::table('users', function (Blueprint $table) {
            $table->string('signature', 250)->nullable()->after('profile_image');
            $table->string('father_name', 250)->nullable()->after('signature');
            $table->string('spouse_name', 250)->nullable()->after('father_name');
            $table->string('mother_name', 250)->nullable()->after('spouse_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('signature');
            $table->dropColumn('father_name');
            $table->dropColumn('spouse_name');
            $table->dropColumn('mother_name');
        });
    }
};
