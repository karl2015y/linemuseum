<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberUsedVoucherRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_used_voucher_records', function (Blueprint $table) {
            $table->id();

            //兌換券id
            $table->foreignId('voucher_id')->references('id')->on('vouchers');
            //兌換券名稱
            $table->string('voucher_name');
            //民眾id
            $table->foreignId('member_id')->references('id')->on('members');
            //民眾名稱
            $table->string('member_name');
            // 消費點
            $table->integer('pay_point')->default(0);
            // 知識點
            $table->integer('knowledge_point')->default(0);
            //開始時間
            $table->timestamp('start_at');
            //結束時間
            $table->timestamp('end_at');
            //簡介
            $table->text('description')->nullable();
            //主圖片位置
            $table->text('pic_1')->nullable();
            //副圖片位置
            $table->text('Pic_2')->nullable();

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
        Schema::dropIfExists('member_used_voucher_records');
    }
}
