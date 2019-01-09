<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBshCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsh_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('case_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone');
            $table->string('lat1')->nullable();
            $table->string('lng1')->nullable();
            $table->string('address1', 4000)->nullable();
            $table->string('lat2')->nullable();
            $table->string('lng2')->nullable();
            $table->string('address2', 4000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsh_cases');
    }
}
