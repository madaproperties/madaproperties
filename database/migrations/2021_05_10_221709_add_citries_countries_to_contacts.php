<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitriesCountriesToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
          // relation To countriescities
          $table->unsignedBigInteger('country_id')->nullable();
          $table->foreign('country_id')->references('id')
          ->on('countries')->onDelete('set null');
          // relation To cities
          $table->unsignedBigInteger('city_id')->nullable();
          $table->foreign('city_id')->references('id')
          ->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
}
