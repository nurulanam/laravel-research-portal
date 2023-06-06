<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('user_id');
            $table->string('user_avatar');
            $table->string('gender')->comment('male, female, non-binary, prefer-not-to-say');
            $table->date('date_of_birth')->comment('must be 18+');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('company_size');
            $table->string('ethnicity')->comment('american-indian-or-alaska-native, asian, white-caucasian, pacific-islander, african-american, hispanic, multiracial, other');
            $table->string('education_level')->comment('less-than-a-high-school-diploma,  high-school-diploma-or-equivalent, some-college-no-degree, associate-degree, bachelors-degree, masters-degree, professional-degree, doctorate ');
            $table->string('employment_status')->comment('self-employed, homemaker, employed-part-time,employed-full-time, not-employed-looking-for-work, not-employed-not-looking-for-work, retired, unable-to-work ');
            $table->string('household_income');
            $table->string('marital_status');
            $table->string('children_in_living');
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
        Schema::dropIfExists('profiles');
    }
}
