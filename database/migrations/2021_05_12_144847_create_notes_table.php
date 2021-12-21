<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            // relation To user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('set null');
            // relation To contact_id
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')
            ->on('contacts')->onDelete('set null');
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
        Schema::dropIfExists('notes');
    }
}
