<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_verifications', function(Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('requests', function(Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('trackings', function(Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trackings', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('requests', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('mobile_verifications', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
