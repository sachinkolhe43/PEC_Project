<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("academic_year",10);
            $table->string("department",10);
            $table->string("project_id",20);
            $table->string("mentor_dept",10);
            $table->string("mentor_name",50);
            $table->string("project_title",400);
            $table->string("project_desc",800);
            $table->string("project_out",800);
            $table->string("project_pdf",100);
            $table->string("project_vid",100);
            $table->string("project_assign_status",15);
            $table->string("res_dec_status",20)->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
