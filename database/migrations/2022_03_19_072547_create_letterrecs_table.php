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
      Schema::create('letterrecs', function (Blueprint $table) {
         $table->id('recid');
         $table->bigInteger('sendregid');
         $table->bigInteger('regrecid');
         $table->smallInteger('recfromid');
         $table->smallInteger('rectoid');
         $table->string('reccomment', 100);
         $table->date('recdate');
         $table->char('recstatus', 1);
         $table->string('recname', 100);
         $table->string('recfile', 100);
         $table->smallInteger('recunitid');
         $table->char('rectype', 1);
         $table->string('recaction', 1);
         $table->string('recfleg', 1);
         $table->date('recreply');
         $table->string('recyear', 4);
         $table->timestamp('rectimestamp');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letterrecs');
    }
};
