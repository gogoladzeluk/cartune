<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsOfficeDeliveryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_office_delivery_reports', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('destination');
            $table->string('reference')->nullable();
            $table->string('reason')->nullable();
            $table->string('timestamp')->nullable();
            $table->string('operator')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sms_office_delivery_reports');
    }
}
