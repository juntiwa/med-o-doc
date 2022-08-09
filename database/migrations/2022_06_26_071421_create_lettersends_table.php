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
        Schema::create('lettersends', function (Blueprint $table) {
            $table->id('sendregid');
            $table->unsignedBigInteger('sendid');
            $table->unsignedBigInteger('regrecid');
            $table->unsignedSmallInteger('sendunitid');
            $table->unsignedSmallInteger('sendtoid');
            $table->string('sendempid', 20);
            $table->string('sendcomment', 100);
            $table->date('senddate');
            $table->date('recdate')->nullable();
            $table->char('sendstatus', 1);
            $table->string('recstatus', 1);
            $table->string('sendname', 50);
            $table->string('recname', 50)->nullable();
            $table->string('sendfile', 255);
            $table->char('sendtype', 1);
            $table->string('sendaction', 1);
            $table->string('sendreport', 1);
            $table->date('sendreply')->nullable();
            $table->string('sendyear', 4);
            $table->timestamp('sendtimestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lettersends');
    }
};
