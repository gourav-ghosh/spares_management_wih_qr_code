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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('machine_id')->unique()->nullable()->default(null);
            $table->string('machine_name')->nullable()->default(null);
            $table->string('machine_type')->nullable()->default(null);
            $table->enum('department', ['admin', 'hr', 'mcl', 'ccl', 'mechanical', 'electrical']);
            $table->text('description')->nullable()->default(null);
            $table->date('last_maintenance_date')->nullable()->default(null);
            $table->date('due_maintenance_date')->nullable()->default(null);
            $table->date('operation_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
