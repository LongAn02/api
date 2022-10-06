<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('discount_type_id');
            $table->foreignId('discount_id')->constrained('discounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('detailID')->unsigned();
            $table->timestamps();

            $table->foreign('discount_type_id')->references('id')->on('discount_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_detail');
    }
};
