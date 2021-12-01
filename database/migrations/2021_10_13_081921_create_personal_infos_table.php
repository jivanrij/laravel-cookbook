<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInfosTable extends Migration
{

    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();

            // This makes the needed field for the belongsTo relation with table users
            $table->foreignIdFor(User::class)->constrained();
            // is short for:
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // Optional:
            // $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('title')->index();
            $table->string('hobby');
            $table->string('nickname');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
}
