<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('office_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->after('office_id')->constrained()->nullOnDelete();
            $table->date('appointment_date')->nullable()->after('service_id');
            $table->string('status')->default('pending')->after('appointment_time');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('office_id');
            $table->dropConstrainedForeignId('service_id');
            $table->dropColumn(['appointment_date', 'status', 'notes']);
        });
    }
};
