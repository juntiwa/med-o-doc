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
      Schema::create('activity_logs', function (Blueprint $table) {
         $table->id();
         $table->string('username');
         $table->string('office_name');
         $table->string('action');
         $table->string('type');
         $table->string('url');
         $table->string('method');
         $table->string('user_agent');
         $table->string('date_time');
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
      Schema::dropIfExists('activity_logs');
   }
};
