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
        Schema::create('zamowienies', function (Blueprint $table) {
            $table->id();
            $table->string('orderNumber');
            $table->date('admissionDate');
            $table->date('receiptDate');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('contractor_id');
            $table->integer('dimensions_id');
            $table->string('width');
            $table->string('height');
            $table->string('thickness');
            $table->integer('typeOfGlass_id');
            $table->integer('nameOfGlass_id');
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
                ->on('kontrahents')
                ->onDelete('cascade');

            $table->foreign('dimensions_id')
                ->references('code_id')
                ->on('lexicons')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zamowienies');
    }
}
