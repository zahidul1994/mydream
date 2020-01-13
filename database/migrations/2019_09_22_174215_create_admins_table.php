<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('firstname');
             $table->string('lastname')->nullable();
            $table->string('email')->unique();
             $table->string('image')->nullable();
           $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('gender')->unsigned()->nullable();
            $table->foreign('gender')->references('id')->on('genders')->onDelete('cascade');
            $table->bigInteger('status')->unsigned()->nullable();
            $table->foreign('status')->references('id')->on('statuses')->onDelete('cascade');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('admins');
    }
}
