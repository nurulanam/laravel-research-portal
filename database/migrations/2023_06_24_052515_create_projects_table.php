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
            $table->unsignedBigInteger('user_id');
            $table->string('my_project_name');
            $table->string('study_title');
            $table->text('study_description');
            $table->string('target_audience');
            $table->string('project_type');
            $table->string('research_type')->nullable();
            $table->integer('required_time');
            $table->integer('participant_incentive');
            $table->string('target_participant');
            $table->integer('total_incentive');
            $table->integer('total_service_fee');
            $table->integer('total_coast');
            $table->string('slug')->unique();

            $table->string('status')->comment('publish, draft');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
