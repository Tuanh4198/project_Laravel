<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMessenger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_messenger', function (Blueprint $table) {
            $table->Increments('messenger_id');
            $table->string('messenger_name');
            $table->string('messenger_email');
            $table->string('messenger_decs');
            $table->string('messenger_content');
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
        Schema::dropIfExists('tbl_messenger');
    }
}
