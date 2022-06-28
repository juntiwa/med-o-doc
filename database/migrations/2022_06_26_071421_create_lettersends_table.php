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
            $table->date('recdate');
            $table->char('sendstatus', 1);
            $table->string('recstatus', 1);
            $table->string('sendname', 50);
            $table->string('recname', 50);
            $table->char('sendfile', 1);
            $table->char('sendtype', 1);
            $table->string('sendaction', 1);
            $table->string('sendreport', 1);
            $table->date('sendreply');
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
