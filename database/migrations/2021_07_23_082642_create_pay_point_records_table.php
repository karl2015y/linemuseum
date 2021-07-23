<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayPointRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_point_records', function (Blueprint $table) {
            $table->id();

            //商店id
            $table->foreignId('shop_id')->references('id')->on('shops');
            //商店名稱
            $table->string('shop_name');
            //民眾id
            $table->foreignId('member_id')->references('id')->on('members');
            //民眾名稱
            $table->string('member_name');
            //消費金額
            $table->integer('price');
            //獲得消費點
            $table->integer('point');

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
        Schema::dropIfExists('pay_point_records');
    }
}
