<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('movie_alts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('tv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('media_paths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('media', ['movie', 'tv', 'alt', 'temp']);
            $table->integer('media_id')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('owner');
            $table->string('slug')->unique();
            $table->timestamp('expires_at');
            $table->string('pass');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('link_items', function (Blueprint $table) {
            $table->id();
            $table->integer('link_id');
            $table->integer('file_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('downloads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('link_id');
            $table->ipAddress('ip_address');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('media_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('path_id')->nullable();
            $table->string('filename');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('movie_alts');
        Schema::dropIfExists('tv');
        Schema::dropIfExists('temp');
        Schema::dropIfExists('media_paths');
        Schema::dropIfExists('links');
        Schema::dropIfExists('link_items');
        Schema::dropIfExists('downloads');
    }
};
