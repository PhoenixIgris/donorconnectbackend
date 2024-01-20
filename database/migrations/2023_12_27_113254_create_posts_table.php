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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('desc');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->json('tag_id')->nullable();
            $table->json('comment_list')->nullable();
            $table->integer('user_id');
            $table->integer('queue_id')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('no_of_comments')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
