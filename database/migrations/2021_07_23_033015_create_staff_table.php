<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

            //使用者id
            $table->foreignId('user_id')->references('id')->on('users');
            //館舍人員名稱
            $table->string('name');
            //館舍人員信箱
            $table->string('email')->unique();
            // 簡介
            $table->text('description')->nullable();
            //建立的總管人員id
            $table->foreignId('created_staff_id')->references('id')->on('staff')->nullable();
            //更新的總管人員id
            $table->foreignId('updated_staff_id')->references('id')->on('staff')->nullable();
        
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
        Schema::dropIfExists('staff');
    }
}
