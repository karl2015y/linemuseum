<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_ways', function (Blueprint $table) {
            $table->id();

            //兌換券id
            $table->foreignId('voucher_id')->references('id')->on('vouchers');
            // 消費點
            $table->integer('pay_point')->default(0);
            // 知識點
            $table->integer('knowledge_point')->default(0);


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
        Schema::dropIfExists('voucher_ways');
    }
}
