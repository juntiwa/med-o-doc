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
         $table->string('username')->nullable();
         $table->string('fname')->nullable();
         $table->string('lname')->nullable();
         $table->string('email')->nullable();
         $table->string('description')->nullable();
         $table->string('date_time')->nullable();
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
