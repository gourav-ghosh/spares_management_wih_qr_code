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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('machine_id')->unsigned()->default(null);
            $table->foreign('machine_id')->references('id')->on('machines'); 
            $table->bigInteger('spare_id')->unsigned()->default(null);
            $table->foreign('spare_id')->references('id')->on('spares');
            $table->string('defect')->nullable()->default(null);
            $table->bigInteger('operator_approval')->unsigned()->default(null);
            $table->foreign('operator_approval')->references('id')->on('users');
            $table->bigInteger('incharge_approval')->unsigned()->default(null);
            $table->foreign('incharge_approval')->references('id')->on('users');
            $table->timestamp('maintenance_completed')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
