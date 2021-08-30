<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("academic_year",10);
            $table->string("department",10);
            $table->integer("group_count");
            $table->string("project_id",20);
            $table->string("ucid",20);
            $table->string("category",2);
            $table->string("name",100);
            $table->string("email",50);
            $table->string("mobile",10);
            $table->string("proj_eval_status",20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
