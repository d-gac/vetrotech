<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZamowieniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('month');
            $table->integer('year');
            $table->string('orderNumber');
            $table->date('admissionDate');
            $table->date('receiptDate');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('contractor_id');
            $table->integer('dimensions_id');
            $table->integer('width');
            $table->integer('height');
            $table->integer('thickness');
            $table->integer('typeOfGlass_id');
            $table->integer('nameOfGlass_id');
            $table->string('treatment');
            $table->integer('quantity');
            $table->double('amount');
            $table->integer('numberDepartment_id');
            $table->string('comments')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->onDelete('cascade');

//            $table->foreign('dimensions_id')
//                ->references('code_id')
//                ->on('lexicons');
//
//            $table->foreign('typeOfGlass_id')
//                ->references('code_id')
//                ->on('lexicons');
//
//            $table->foreign('nameOfGlass_id')
//                ->references('code_id')
//                ->on('lexicons');
//
//            $table->foreign('numberDepartment_id')
//                ->references('code_id')
//                ->on('lexicons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
