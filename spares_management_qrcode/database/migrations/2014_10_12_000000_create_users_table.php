<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable()->default(null);
            $table->enum('role', ['admin', 'hr', 'manager', 'deputy_manager', 'assistant_manager', 'senior_executive', 'executive', 'senior_associate', 'associate'])->default('associate');
            $table->enum('department', ['admin', 'hr', 'mechanical_maintenance', 'mcl_operations', 'ccl_operations']);
            $table->date('joining_date')->default(Carbon::now()->toDateString());
            $table->date('leaving_date')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->rememberToken();
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