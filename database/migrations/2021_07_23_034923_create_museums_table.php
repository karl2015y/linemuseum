<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museums', function (Blueprint $table) {
            $table->id();
            //使用者id
            $table->foreignId('user_id')->references('id')->on('users');
            //館舍名稱
            $table->string('name');
            //狀態
            $table->enum('status', ['enable', 'disable'])->default('enable');
            //館舍地址
            $table->string('address');
            //館舍電話
            $table->string('phone');
            //館舍人員信箱
            $table->string('email')->unique();
            //消費百點送
            $table->integer('buy_hundred_get_point')->default(1); 
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
        Schema::dropIfExists('museums');
    }
}
