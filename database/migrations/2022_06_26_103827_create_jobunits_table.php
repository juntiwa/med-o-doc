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
        Schema::create('jobunits', function (Blueprint $table) {
            $table->id('id');
            $table->integer('unitid');
            $table->string('unitname', 255);
            $table->bigInteger('unitlevel')->default(0);
            $table->string('unitengname', 255);
            $table->string('shotunitname', 255);
            $table->timestamp('datein');
            $table->integer('userin');
            $table->string('status', 1);
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
        Schema::dropIfExists('jobunits');
    }
};
