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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('path')->nullable()->default(null);

            $table->string('thumbnail_name')->nullable()->default(null);
            $table->string('thumbnail_path')->nullable()->default(null);
            // $table->enum('for_status', [''])->default('');
            $table->enum('media_type', ['image','video'])->nullable()->default(null);
            $table->bigInteger('machine_id')->unsigned()->nullable()->default(null);
            $table->foreign('machine_id')->references('id')->on('machines'); 
            $table->bigInteger('spare_id')->unsigned()->nullable()->default(null);
            $table->foreign('spare_id')->references('id')->on('spares'); 

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users'); 
            $table->text('comment')->nullable()->default(null);
            $table->bigInteger('commented_by')->unsigned()->nullable()->default(null);
            $table->foreign('commented_by')->references('id')->on('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
