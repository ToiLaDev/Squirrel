<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name')->nullable();
            $table->string('collection_name')->default('default')->index();
            $table->string('mime_type')->nullable()->index();
            $table->unsignedBigInteger('size')->default(0);
            $table->string('md5')->nullable();
            $table->string('sha1')->nullable();
            $table->enum('type', ['file', 'folder'])->default('file');
            $table->bigInteger('folder_id')->nullable()->index();
            $table->string('disk')->default('local');
            $table->text('properties')->nullable();
            $table->text('conversions')->nullable();
            $table->bigInteger('owner_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['owner_id', 'folder_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
