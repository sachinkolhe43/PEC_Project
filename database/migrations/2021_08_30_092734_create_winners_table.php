<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->id();
            $table->string("academic_year",10);
            $table->string("department",10);
            $table->integer("pro_rank");
            $table->string("project_id",20);
            $table->string("project_title",500);
            $table->string("res_dec_date",10);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winners');
    }
}
