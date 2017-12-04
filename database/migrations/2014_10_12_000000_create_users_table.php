<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('user_id');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('birth_date')->nullable();
            $table->string('user_city');
            $table->string('user_country');
            $table->string('languages')->nullable();
            $table->string('competences')->nullable();
            $table->integer('phone_number')->nullable();
            $table->boolean('is_available')->default(0);
            $table->boolean('is_freelancer')->default(0);
            $table->boolean('is_permanent')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->string('password');
            //linkedin id
            $table->string('linkedin_id');
            $table->rememberToken();
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
