<?php

use App\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
//    Post::truncate();

    Schema::create('posts', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title');
      $table->text('description');
      $table->text('content');
      $table->string('image');
      $table->integer('category_id');
      /*$table->foreign('category_id')
        ->references('id')
        ->on('category')
        ->onDelete('cascade');*/
      $table->timestamp('published_at')->nullable();
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
