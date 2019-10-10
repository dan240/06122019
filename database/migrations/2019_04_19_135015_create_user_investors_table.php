<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_investors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid');
            $table->string('firmTagline');
            $table->mediumText('profileText');
            $table->mediumText('jobTitle');
            $table->string('country');
            $table->string('city');
            $table->string('investorfirmUrl');
            $table->string('linkedinUrl');
            $table->string('fbUrl');
            $table->string('twitterUrl');
            $table->string('slideshareUrl');
            $table->string('investorFirmvideo');
            $table->string('investorType');
            $table->string('investmentType');
            $table->string('sectorFocus');
            $table->string('industryFocus');
            $table->string('regionFocus');
            $table->string('countryFocus');
            $table->string('assetUndermgmt');
            $table->string('investmentRangefrm');
            $table->string('investmentRangeto');
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
        Schema::dropIfExists('user_investors');
    }
}
