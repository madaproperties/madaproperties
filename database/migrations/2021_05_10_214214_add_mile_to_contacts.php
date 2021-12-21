<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMileToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
          $table->string('currency')->nullable();
          $table->string('purpose')->nullable();
          $table->string('purpose_type')->nullable();
          $table->integer('unit_country')->nullable();
          $table->integer('unit_city')->nullable();
          $table->string('unit_zone')->nullable();
          // relation To miles
          $table->unsignedBigInteger('mile_id')->nullable();
          $table->foreign('mile_id')->references('id')
          ->on('last_mile_conversions')->onDelete('set null');
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
