<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
   public function up(): void
   {
       Schema::table('appointments', function (Blueprint $table) {
           if (!Schema::hasColumn('appointments', 'office_id')) {
               $table->foreignId('office_id')
                   ->nullable()
                   ->after('user_id')
                   ->constrained()
                   ->nullOnDelete();
           }
           if (!Schema::hasColumn('appointments', 'service_id')) {
               $table->foreignId('service_id')
                   ->nullable()
                   ->after('office_id')
                   ->constrained()
                   ->nullOnDelete();
           }
           if (!Schema::hasColumn('appointments', 'appointment_date')) {
               $table->date('appointment_date')
                   ->nullable()
                   ->after('service_id');
           }
           if (!Schema::hasColumn('appointments', 'status')) {
               $table->string('status')
                   ->default('pending')
                   ->after('appointment_time');
           }
           if (!Schema::hasColumn('appointments', 'notes')) {
               $table->text('notes')
                   ->nullable()
                   ->after('status');
           }
       });
   }
   public function down(): void
   {
       Schema::table('appointments', function (Blueprint $table) {
           if (Schema::hasColumn('appointments', 'office_id')) {
               $table->dropConstrainedForeignId('office_id');
           }
           if (Schema::hasColumn('appointments', 'service_id')) {
               $table->dropConstrainedForeignId('service_id');
           }
           $columnsToDrop = [];
           if (Schema::hasColumn('appointments', 'appointment_date')) {
               $columnsToDrop[] = 'appointment_date';
           }
           if (Schema::hasColumn('appointments', 'status')) {
               $columnsToDrop[] = 'status';
           }
           if (Schema::hasColumn('appointments', 'notes')) {
               $columnsToDrop[] = 'notes';
           }
           if (!empty($columnsToDrop)) {
               $table->dropColumn($columnsToDrop);
           }
       });
   }
};
