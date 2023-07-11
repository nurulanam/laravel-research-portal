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
            $table->string('internal_name');
            $table->string('project_title');
            $table->text('project_details');
            $table->string('audience');
            $table->string('research_type');
            $table->string('research_method')->nullable();
            $table->integer('required_time')->nullable();
            $table->integer('incentive');
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
