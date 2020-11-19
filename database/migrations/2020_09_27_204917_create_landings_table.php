<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing', function (Blueprint $table) {
            $table->id();
            $table->string('hero_overtitle');
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_video');
            $table->string('hero_banner');

            $table->string('newsletter_title');
            $table->text('newsletter_text');
            $table->string('newsletter_image');

            $table->string('service1_title');
            $table->text('service1_text');
            $table->string('service1_image');

            $table->string('service2_title');
            $table->text('service2_text');
            $table->string('service2_image');

            $table->text('gallery')->nullable();

            $table->string('whoami_title');
            $table->text('whoami_text');
            $table->string('whoami_image');

            $table->string('getstarted1_title');
            $table->text('getstarted1_text');
            $table->string('getstarted2_title');
            $table->text('getstarted2_text');
            $table->string('getstarted3_title');
            $table->text('getstarted3_text');

            $table->string('contact_subtitle');
            $table->string('contact_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing');
    }
}
