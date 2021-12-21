<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('budget')->nullable();
            // set Leader
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')
            ->on('users')->onDelete('set null');
            //
            // relation To Projects
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')
            ->on('statuses')->onDelete('set null');
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
