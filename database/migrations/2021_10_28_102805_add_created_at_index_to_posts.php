<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedAtIndexToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Adds an index on posts.created_at
            Schema::table('posts', function (Blueprint $table) {
                $table->index('created_at');
            });
        });
    }
}
