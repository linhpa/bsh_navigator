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
            $table->integer('user_id');
            $table->string('case_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('lat1');
            $table->string('lng1');
            $table->string('address1', 4000);
            $table->string('lat2');
            $table->string('lng2');
            $table->string('address2', 4000);
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
