<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            //館舍id
            $table->foreignId('museum_id')->references('id')->on('museums');
            //使用者id
            $table->foreignId('user_id')->references('id')->on('users');
            //商家名稱
            $table->string('name');
            //狀態
            $table->enum('status', ['enable', 'disable'])->default('enable');
            //商家電話
            $table->string('phone')->unique();
            //商家簡介
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
        Schema::dropIfExists('shops');
    }
}
