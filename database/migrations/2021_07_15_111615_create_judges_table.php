<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judges', function (Blueprint $table) {
            $table->id();
            $table->string("jtype",20);
            $table->string("jname",100);
            $table->string("jemail",50);
            $table->string("jmobile",10);
            $table->string("jcompany",100);
            $table->string("jexp",20);
            $table->string("jpassword",15);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judges');
    }
}
