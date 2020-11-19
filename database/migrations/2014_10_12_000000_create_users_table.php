<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('role')->default('client');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('city')->nullable();
            $table->boolean('use_same_address')->nullable();
            $table->string('billing_address_1')->nullable();
            $table->string('billing_address_2')->nullable();
            $table->string('billing_cp', 5)->nullable();
            $table->string('billing_city')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
