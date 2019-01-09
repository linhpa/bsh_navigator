<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBshCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bsh_cases', function (Blueprint $table) {
            $table->dateTime('case_time')->nullable();
            $table->string('case_location', 1024)->nullable();
            $table->string('driver_info', 1024)->nullable();
            $table->string('case_detail_info', 1024)->nullable();
            $table->string('damage_level', 128)->nullable();
            $table->string('done_jobs', 1024)->nullable();
            $table->string('note', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bsh_cases', function (Blueprint $table) {
            $table->dropColumn(['case_time', 'case_location', 'driver_info', 'case_detail_info', 'damage_level', 'done_jobs', 'note']);
        });
    }
}
