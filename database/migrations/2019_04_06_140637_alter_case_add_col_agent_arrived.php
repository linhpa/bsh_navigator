<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCaseAddColAgentArrived extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bsh_cases', function (Blueprint $table) {
            $table->boolean('agent_arrived')->default(false);
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
            $table->dropColumn('agent_arrived');
        });
    }
}
