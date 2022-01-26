<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInputFormatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_headers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('input_formats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('header_id')->nullable();
            $table->foreign('header_id')->references('id')->on('input_headers')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('input_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('input_format_id')->nullable();
            $table->foreign('input_format_id')->references('id')->on('input_formats')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('input_headers');
        Schema::dropIfExists('input_formats');
        Schema::dropIfExists('input_options');
    }
}
