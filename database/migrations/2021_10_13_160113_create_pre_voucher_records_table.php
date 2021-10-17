<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreVoucherRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_voucher_records', function (Blueprint $table) {
            $table->id();
            //使用者id
            $table->foreignId('user_id')->references('id')->on('users');
            // 收件人名稱
            $table->string('name');
            // 收件人email
            $table->string('email');
            // 收件人地址
            $table->string('address');
            // 收件人電話
            $table->string('phone');
            //購買備註
            $table->text('user_note')->nullable();
            //寄出備註
            $table->text('member_note')->nullable();
            // 狀態
            $table->text('status_list')->nullable();
            $table->enum('current_status', ['準備中', '已寄出'])->default('準備中');
            //兌換券紀錄id
            $table->foreignId('voucher_record_id')->references('id')->on('member_used_voucher_records');
            //兌換券id
            $table->foreignId('voucher_id')->references('id')->on('vouchers');

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
        Schema::dropIfExists('pre_voucher_records');
    }
}
