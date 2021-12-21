<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotoficationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notofications', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->enum('is_read',[0,1])->default(0);
            // relation To Projects
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')
            ->on('users')->onDelete('set null');
            // set Leader
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('notofications');
    }
}
