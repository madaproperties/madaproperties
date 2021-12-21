<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['call','email','meeting','whatsapp'])->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('duration')->nullable();
            $table->string('call_outcome')->nullable();
            $table->longText('description')->nullable();
            // relation To connected
            $table->unsignedBigInteger('connected_id')->nullable();
            $table->foreign('connected_id')->references('id')
            ->on('users')->onDelete('set null');
            // relation To user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('set null');
            // relation To contact_id
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')
            ->on('contacts')->onDelete('set null');
            $table->timestamps();


            // 
            $table->enum('is_log',['0','1'])->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
