<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tn'); // табельный номер
            $table->string('name');
            $table->string('lastname');
            $table->string('patronymic');
            $table->string('birthday')->default('');
            $table->string('phone_mobile')->default('');
            $table->string('phone_home')->default('');
            $table->string('prof')->default('');
            $table->string('dept')->default('');
            $table->string('city')->default('');
            $table->string('street')->default('');
            $table->string('house')->default('');
            $table->string('apartment')->default('');
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
        Schema::dropIfExists('phonebooks');
    }
}
