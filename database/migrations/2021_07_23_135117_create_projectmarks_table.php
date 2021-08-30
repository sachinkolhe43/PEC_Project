<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectmarks', function (Blueprint $table) {
            $table->id();
            $table->string("academic_year",10);
            $table->string("department",10);
            $table->string("project_id",20)->unique();
            $table->float('project_marks', 5, 2);
            $table->string("res_dec_date",20)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectmarks');
    }
}
