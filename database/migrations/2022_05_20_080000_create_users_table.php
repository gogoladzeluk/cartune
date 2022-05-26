<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->unique();
            $table->string('profile_picture')->nullable();
            $table->unsignedTinyInteger('type')->index();
            $table->string('password');
            $table->rememberToken();

            // mechanic fields
            $table->boolean('active')->default(false)->index();
            $table->foreignId('town_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->string('address')->nullable();
            $table->string('garage_picture')->nullable();

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
        Schema::dropIfExists('users');
    }
}
