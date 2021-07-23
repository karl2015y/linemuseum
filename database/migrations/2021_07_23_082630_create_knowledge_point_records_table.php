<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgePointRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_point_records', function (Blueprint $table) {
            $table->id();

            //知識點活動id
            $table->foreignId('knowledge_activity_id')->references('id')->on('knowledge_activities');
            //活動名稱
            $table->string('knowledge_activity_name');
            //民眾id
            $table->foreignId('member_id')->references('id')->on('members');
            //民眾名稱
            $table->string('member_name');
            //獲得知識點
            $table->integer('point');



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
        Schema::dropIfExists('knowledge_point_records');
    }
}
