<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('first_name_normalised')->virtualAs("regexp_replace(first_name, '[^A-Za-z0-9]','')")->index();
            $table->string('middle_name')->nullable(true);
            $table->string('last_name');
            $table->string('last_name_normalised')->virtualAs("regexp_replace(last_name, '[^A-Za-z0-9]','')")->index();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
