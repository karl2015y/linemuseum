<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();

            //兌換券名稱
            $table->string('name');
            //狀態
            $table->enum('status', ['enable', 'disable'])->default('enable');
            //開始時間
            $table->timestamp('start_at');
            //結束時間
            $table->timestamp('end_at');
            //兌換券數量
            $table->integer('amount')->default(0);
            //簡介
            $table->text('description')->nullable();
            //主圖片位置
            $table->text('pic_1')->nullable();
            //副圖片位置
            $table->text('Pic_2')->nullable();
            //建立的總管人員id
            $table->foreignId('created_staff_id')->nullable();
            //更新的總管人員id
            $table->foreignId('updated_staff_id')->nullable();

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
        Schema::dropIfExists('vouchers');
    }
}
