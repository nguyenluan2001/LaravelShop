<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->string('slug');
            $table->text('post_desc');
            $table->string('post_img');
            $table->unsignedBigInteger('user_id');
            $table->text('post_content');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('post_cats')->onDelete('cascade');
            $table->unsignedBigInteger('sub_cat_id');
            $table->foreign('sub_cat_id')->references('id')->on('post_sub_cats')->onDelete('cascade');
            $table->unsignedBigInteger('views');

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
        Schema::dropIfExists('posts');
    }
}
