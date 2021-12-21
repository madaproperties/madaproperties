<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('scound_phone')->nullable();
            $table->string('last_mile_conversion')->nullable();
            $table->string('campaign')->nullable();
            $table->string('source')->nullable();
            $table->string('medium')->nullable();
            $table->string('lang')->nullable();
            $table->string('lead_type')->nullable();
            $table->string('created_form')->nullable();
            // relation To Projects
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')
            ->on('projects')->onDelete('set null');

            // relation To users
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('set null');
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
        Schema::dropIfExists('contacts');
    }
}
