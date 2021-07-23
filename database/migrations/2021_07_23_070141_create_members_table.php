<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            //使用者id
            $table->foreignId('user_id')->references('id')->on('users');
            // 性別
            $table->enum('gender', ['male', 'female'])->default('male');
            // 年齡區間
            $table->enum('years', ['under20', '21to30', '31to40', '41to50', '51to60', 'up61']);
            // 民眾名稱
            $table->string('name');
            // 居住區域
            $table->string('address_region');
            // 民眾信箱
            $table->string('email')->unique();
            // 聯絡電話
            $table->string('phone');
            // 推薦單位
            $table->string('recommend_museum');
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
        Schema::dropIfExists('members');
    }
}
