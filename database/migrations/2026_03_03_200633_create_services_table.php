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
        Schema::create('services', function (Blueprint $table) {
<<<<<<< HEAD
    $table->id();
    $table->foreignId('office_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('fee', 8, 2)->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
=======
            $table->id();
            $table->foreignId('office_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('fee', 8, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
>>>>>>> main
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
