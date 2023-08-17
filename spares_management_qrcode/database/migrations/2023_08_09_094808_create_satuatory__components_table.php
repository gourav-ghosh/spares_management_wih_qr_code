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
        Schema::create('satuatory__components', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique()->nullable()->default(null);
            $table->string('product_name')->nullable()->default(null);
            $table->enum('type', ['pressure_vessel', 'lifting_tools'])->nullable()->default(null); //  , 'calibration'
            $table->boolean('certification_status')->default(false);
            $table->date('calibration_due_date')->nullable()->default(null);
            $table->date('last_calibration_date')->nullable()->default(null);
            $table->text('details')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satuatory__components');
    }
};