<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('external_id');
            $table->text('description');
            $table->string('headline');
            $table->string('location')->nullable();
            $table->string('jobBeginDate')->nullable();
            $table->string('applicationdeadline')->nullable();
            $table->string('duration')->nullable();
            $table->string('country');
            $table->boolean('externalAdIsPublished')->default(0);
            $table->string('advertisingType');
            $table->string('searchEmail');
            $table->text('footer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobads');
    }
}
