<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('hash')->nullable();
            $table->enum('lang',['ar','en'])->nullable();
            $table->enum('rule',['manger','leader','seller']);
            $table->enum('active',[1,0])->default(1);
            $table->dateTime('last_login')->nullable();
            // set Leader
            $table->unsignedBigInteger('leader')->nullable();
            $table->foreign('leader')->references('id')
            ->on('users')->onDelete('set null');

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
