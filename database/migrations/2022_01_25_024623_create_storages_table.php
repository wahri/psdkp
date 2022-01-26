<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('lockers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('locker_id')->nullable();
            $table->foreign('locker_id')->references('id')->on('lockers')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('rack_id')->nullable();
            $table->foreign('rack_id')->references('id')->on('racks')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('storages');
    }
}
