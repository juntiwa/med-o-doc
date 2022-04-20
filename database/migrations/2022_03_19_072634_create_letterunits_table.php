<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('letterunits', function (Blueprint $table) {
         $table->id('unitid');
         $table->bigInteger('unitlevel');
         $table->string('unitname', 255);
         $table->timestamp('datein');
         $table->smallInteger('userin');
         $table->string('status', 1);
         $table->string('unitengname', 255);
         $table->string('level', 1);
         $table->tinyInteger('unittype');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letterunits');
    }
};
