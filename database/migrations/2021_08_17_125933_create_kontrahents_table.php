<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrahentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrahents', function (Blueprint $table) {
            $table->id();
            $table->boolean('type');
            $table->string('companyName');
            $table->string('lname');
            $table->string('fname');
            $table->string('location')->nullable();
            $table->integer('postalCode')->nullable();
            $table->string('street')->nullable();
            $table->string('numberHouse')->nullable();
            $table->string('numberApartment')->nullable();
            $table->integer('numberPhone');
            $table->string('email');
            $table->string('comments')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrahents');
    }
}
