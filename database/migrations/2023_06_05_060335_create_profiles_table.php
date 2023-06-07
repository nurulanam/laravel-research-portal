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
            $table->unsignedBigInteger('user_id');
            $table->string('user_avatar')->nullable();
            $table->string('gender')->nullable()->comment('male, female, non-binary, prefer-not-to-say');
            $table->date('date_of_birth')->nullable()->comment('must be 18+');
            $table->string('phone')->nullable();
            $table->string('country')->default('us');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('job_title')->nullable()->comment('owner-or-operator, hairstylist-owner-or-operator, co-owner-or-operator, small-business-owner-or-operator, owner-or-operator-or-employee, owner-or-operator-and-web-designer, owner-or-operator-or-photographer, owner-or-operator-or-manager, hairstylist-or-makeup-artist-owner-or-operator, mechanic-or-small-business-owner-or-operator');
            $table->string('company_name')->nullable();
            $table->string('company_size')->nullable()->comment('self-employed, 1to10, 11to50, 51to200, 201to500, 501to1000, 1001to5000, 5001to10000, 10000plus');
            $table->string('ethnicity')->nullable()->comment('american-indian-or-alaska-native, asian, white-caucasian, pacific-islander, african-american, hispanic, multiracial, other');
            $table->string('education_level')->nullable()->comment('less-than-a-high-school-diploma,  high-school-diploma-or-equivalent, some-college-no-degree, associate-degree, bachelors-degree, masters-degree, professional-degree, doctorate ');
            $table->string('employment_status')->nullable()->comment('self-employed, homemaker, employed-part-time, employed-full-time, not-employed-looking-for-work, not-employed-not-looking-for-work, retired, unable-to-work ');
            $table->string('household_income')->nullable()->comment('less20000, 20000to34999, 35000to49999, 50000to74999, 75000to99999, 100000plus');
            $table->string('marital_status')->nullable()->comment('single, married, divorced, widowed, living-with-significant-other');
            $table->string('children_in_living')->nullable()->comment('0, 1, 2, 3, 4, 5-plus');
            $table->string('status')->default('active')->comment('active, deactivate');

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
        Schema::dropIfExists('profiles');
    }
}
