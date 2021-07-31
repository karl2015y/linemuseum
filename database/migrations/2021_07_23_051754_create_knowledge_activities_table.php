<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_activities', function (Blueprint $table) {
            $table->id();
            //館舍id
            $table->foreignId('museum_id')->references('id')->on('museums');
            //活動名稱
            $table->string('name');
            //狀態
            $table->enum('status', ['enable', 'disable'])->default('enable');
            //開始時間
            $table->timestamp('start_at');
            //結束時間
            $table->timestamp('end_at');
            //給的知識點
            $table->integer('point')->default(0);
            //獲得週期(h)
            $table->integer('point_cycle_hour')->default(0);
            //獲得週期(m)
            $table->integer('point_cycle_min')->default(0);
            //簡介
            $table->text('description')->nullable();
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
        Schema::dropIfExists('knowledge_activities');
    }
}
