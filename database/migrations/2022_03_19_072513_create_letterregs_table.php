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
      Schema::create('letterregs', function (Blueprint $table) {
         $table->id('regrecid');
         $table->string('regid', 25);
         $table->smallInteger('reground')->nullable();
         $table->string('regtype', 1);
         $table->string('regtype2', 1);
         $table->date('regdate');
         $table->string('regfrom', 5);
         $table->string('regto', 5);
         $table->string('regtitle', 500);
         $table->text('regdetail');
         $table->string('regcomment', 255)->nullable();
         $table->string('regfile', 100)->nullable();
         $table->string('regdoc', 255)->nullable();
         $table->string('regdoc2', 100)->nullable();
         $table->string('filename1', 100)->nullable();
         $table->string('filename2', 100)->nullable();
         $table->date('recdate');
         $table->char('regstatus', 1);
         $table->char('regaction', 1);
         $table->tinyInteger('regunitid')->nullable();
         $table->string('regempid', 20);
         $table->date('regreply')->nullable();
         $table->timestamp('regtimestamp');
         $table->string('train', 1)->nullable();
         $table->string('technique', 1)->nullable();
         $table->string('viewtask', 1)->nullable();
         $table->tinyInteger('amount')->nullable();
         $table->tinyInteger('taskdate')->nullable();
      });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letterregs');
    }
};
