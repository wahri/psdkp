<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_archives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('locker_id')->nullable();
            $table->foreign('locker_id')->references('id')->on('lockers')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('rack_id')->nullable();
            $table->foreign('rack_id')->references('id')->on('racks')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('box_id')->nullable();
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('set null')->onUpdate('cascade');
            $table->string('file');
            // $table->boolean('is_deleted')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('document_archive_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_archive_id')->nullable();
            $table->foreign('document_archive_id')->references('id')->on('document_archives')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('input_format_id')->nullable();
            $table->foreign('input_format_id')->references('id')->on('input_formats')->onDelete('set null')->onUpdate('cascade');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('document_archives');
        Schema::dropIfExists('document_archive_infos');
    }
}
