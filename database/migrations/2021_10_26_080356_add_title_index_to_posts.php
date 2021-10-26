<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleIndexToPosts extends Migration
{
    public function up()
    {
        // Adds an index on posts.title to compare query time with and without an index on the /posts page.
        Schema::table('posts', function (Blueprint $table) {
            $table->index('title');
        });
    }
}
