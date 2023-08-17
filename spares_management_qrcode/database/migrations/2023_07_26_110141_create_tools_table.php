<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_id')->unique()->nullable()->default(null);
            $table->string('tool_name')->unique()->nullable()->default(null);
            $table->string('machine')->unique()->nullable()->default(null);
            $table->enum('safety_status', ['unsafe', 'safe'])->nullable()->default('safe');
            $table->text('location')->nullable()->default(null);
            $table->text('specification')->nullable()->default(null);
            $table->date('last_inspection_date')->nullable()->default(null);
            $table->date('inspection_due_date')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};