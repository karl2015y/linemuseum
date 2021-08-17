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
            // 生日-年
            $table->string('year');
            // 生日-月
            $table->enum('month', ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10" ,"11", "12"]);
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
