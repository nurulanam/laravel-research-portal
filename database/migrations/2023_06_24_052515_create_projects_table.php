<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->string('status')->comment('publish, draft');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
