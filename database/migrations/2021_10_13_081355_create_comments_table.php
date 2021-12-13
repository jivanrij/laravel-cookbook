<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // This makes the needed field for the belongsTo relation with table users
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            // is short for:
            // $table->unsignedBigInteger('post_id');
            // $table->foreign('post_id')->references('id')->on('posts');
            // Optional:
            // $table->foreignId('post_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            $table->string('title');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
