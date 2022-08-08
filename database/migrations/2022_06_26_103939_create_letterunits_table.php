<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letterunits', function (Blueprint $table) {
            $table->id('id');
            $table->integer('unitid');
            $table->unsignedBigInteger('unitlevel');
            $table->string('unitname', 255);
            $table->timestamp('datein');
            $table->unsignedSmallInteger('userin')->nullable();
            $table->string('status', 1)->nullable();
            $table->string('level', 1)->nullable();
            $table->tinyInteger('unittype')->nullable();
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
        Schema::dropIfExists('letterunits');
    }
};
