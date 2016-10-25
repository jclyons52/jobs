<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function(Blueprint $table) {
            $table->string('company');
            $table->decimal('base_salary');
            $table->text('education_requirements');
            $table->string('employment_type');
            $table->dateTime('end_date');
            $table->text('experience_requirements');
            $table->string('industry');
            $table->string('job_title');
            $table->string('provider');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
