<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostsTable extends Migration
{
    public function up()
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->id();

            // This makes the needed field for the belongsTo relation with table users
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            // is short for:
            // $table->unsignedBigInteger('post_id');
            // $table->foreign('post_id')->references('id')->on('posts');
            // Optional:
            // $table->foreignId('post_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            // This makes the needed field for the belongsTo relation with table users
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            // is short for:
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');
            // Optional:
            // $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_post');
    }
}
