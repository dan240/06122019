<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid');
            $table->string('jobTitle');
            $table->string('country');
            $table->string('city');
            $table->string('companyUrl');
            $table->string('fundraisUrl');
            $table->string('linkedinUrl');
            $table->string('fbUrl');
            $table->string('twitterUrl');
            $table->string('slideshareUrl');
            $table->string('investorFirmvideo');
            $table->mediumText('companyTagline');
            $table->mediumText('profileText');
            $table->string('comapnyName');
            $table->string('companyType');
            $table->string('fundingType');
            $table->string('industry');
            $table->string('sector');
            $table->string('ammountRaised');
            $table->string('fundingGoal');
            $table->string('minReservation');
            $table->string('maxReservation');
            $table->string('equity');
            $table->string('openDate');
            $table->string('closingDate');
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
        Schema::dropIfExists('user_companies');
    }
}
