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
            $table->string('bank_name')->nullable()->after('trading_code');
            $table->string('branch_name')->nullable()->after('bank_name');
            $table->string('routing_number')->nullable()->after('branch_name');
            $table->string('bank_account_no')->nullable()->after('routing_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('routing_number');
            $table->dropColumn('bank_account_no');
        });
    }
};
