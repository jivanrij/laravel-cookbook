<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{

    public function up()
    {
//        Schema::disableForeignKeyConstraints();

        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // This makes the needed field for the belongsTo relation with table users
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            // is the same as:
            // $table->foreignId('user_id')->constrained();
            // is short for:
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // Optional:
            // $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('title');

            $table->string('sub_title');

            $table->integer('views')->default(0);

            $table->timestamps();
        });

//        Schema::enableForeignKeyConstraints();
    }


    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
