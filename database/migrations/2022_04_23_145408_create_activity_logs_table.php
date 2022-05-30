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
         $table->string('program_name')->nullable();
         $table->string('url')->nullable();
         $table->string('method')->nullable();
         $table->string('user_agent')->nullable();
         $table->string('action')->nullable();
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
