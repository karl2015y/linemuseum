<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherRecordStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_record_statuses', function (Blueprint $table) {
            $table->id();
            
            //兌換券id
            $table->foreignId('voucher_record_id')->references('id')->on('member_used_voucher_records');
            //兌換券狀態
            $table->enum('status', ['unused', 'used', 'pass'])->default('unused');

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
        Schema::dropIfExists('voucher_record_statuses');
    }
}
