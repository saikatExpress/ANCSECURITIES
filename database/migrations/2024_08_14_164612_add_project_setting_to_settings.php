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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('project_description', 500)->nullable()->after('project_name');
            $table->string('project_url', 500)->nullable()->after('project_description');
            $table->string('project_email', 500)->nullable()->after('project_url');
            $table->string('project_phone', 500)->nullable()->after('project_email');
            $table->string('project_phone1', 500)->nullable()->after('project_phone');
            $table->string('project_phone2', 500)->nullable()->after('project_phone1');
            $table->string('project_phone3', 500)->nullable()->after('project_phone2');
            $table->string('project_address', 500)->nullable()->after('project_phone3');
            $table->string('body_background_color', 500)->nullable()->after('project_address');
            $table->integer('sub_header')->default(0)->after('body_background_color');
            $table->string('facebook_url', 300)->nullable()->after('sub_header');
            $table->string('twiter_url', 300)->nullable()->after('facebook_url');
            $table->string('instagram_url', 300)->nullable()->after('twiter_url');
            $table->string('whatsapp', 30)->nullable()->after('instagram_url');
            $table->integer('registration_status')->default(0)->after('whatsapp');
            $table->integer('otp_status')->default(0)->after('registration_status');
            $table->integer('registation_male')->default(0)->after('otp_status');
            $table->integer('deposite_male')->default(0)->after('registation_male');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('project_description');
            $table->dropColumn('project_url');
            $table->dropColumn('project_email');
            $table->dropColumn('project_phone');
            $table->dropColumn('project_phone1');
            $table->dropColumn('project_phone2');
            $table->dropColumn('project_phone3');
            $table->dropColumn('project_address');
            $table->dropColumn('body_background_color');
            $table->dropColumn('sub_header');
            $table->dropColumn('facebook_url');
            $table->dropColumn('twiter_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('whatsapp');
            $table->dropColumn('registration_status');
            $table->dropColumn('otp_status');
            $table->dropColumn('registation_male');
            $table->dropColumn('deposite_male');
        });
    }
};
