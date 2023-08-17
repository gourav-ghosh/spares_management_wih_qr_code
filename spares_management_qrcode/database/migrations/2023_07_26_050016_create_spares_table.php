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
        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->string('spare_id')->unique()->nullable()->default(null);
            $table->string('spare_name')->nullable()->default(null);
            $table->string('spare_type')->nullable()->default(null);
            /* <------------- DB terms and general terms relation----------------> */
            /*
             *   Roll Stand -> roll_stand
             *   Workshop Area -> workshop
             *   SPM Area -> spm
             *   Oil Storage MCL -> os_mcl
             *   Oil Storage CCL -> os_ccl
             *   MCL Exit -> mcl_exit
             *   JK Bay Area -> jk_bay
             *   CCL DE Bay area -> de_bay
             *   MCL CD Bay area -> cd_bay
             */
            $table->enum('spare_storage', ['roll_stand', 'workshop', 'spm', 'os_mcl', 'os_ccl', 'mcl_exit', 'jk_bay', 'de_bay', 'cd_bay'])->nullable()->default(null);
            $table->enum('department', ['mcl', 'ccl', 'mechanical_maintenance', 'admin', 'hr']);
            $table->bigInteger('parent_machine')->unsigned()->nullable()->default(null);
            $table->foreign('parent_machine')->references('id')->on('machines');
            // $table->string('parent_machine')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->date('last_installation_date')->nullable()->default(null);
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
        Schema::dropIfExists('spares');
    }
};