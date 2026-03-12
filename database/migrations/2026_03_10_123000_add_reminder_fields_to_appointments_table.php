<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('citizen_name')->nullable()->after('service_id');
            $table->string('citizen_email')->nullable()->after('citizen_name');
            $table->string('citizen_phone')->nullable()->after('citizen_email');
            $table->timestamp('email_reminder_sent_at')->nullable()->after('notes');
            $table->timestamp('sms_reminder_sent_at')->nullable()->after('email_reminder_sent_at');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'citizen_name',
                'citizen_email',
                'citizen_phone',
                'email_reminder_sent_at',
                'sms_reminder_sent_at',
            ]);
        });
    }
};
