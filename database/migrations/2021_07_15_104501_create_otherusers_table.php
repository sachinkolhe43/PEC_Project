<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otherusers', function (Blueprint $table) {
            $table->id();
            $table->string("Role",20);
            $table->string("uname",100);
            $table->string("uemail",50);
            $table->string("umobile",10);
            $table->string("upassword",15);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otherusers');
    }
}
