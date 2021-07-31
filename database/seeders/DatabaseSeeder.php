<?php

namespace Database\Seeders;
use Carbon\Carbon;


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\Museum;
use App\Models\Shop;
use App\Models\KnowledgeActivity;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User([
            'name' => 'Karl',
            'email' => 'karl2015y@gmail.com',
            'password' => bcrypt('Aa3345678')
        ]);
        $user->save();

        $staff = new Staff([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'description' => '簡介',
            'created_staff_id' => $user['id'],
        ]);
        $staff->save();

        $museum = new Museum([
            'user_id' =>  $user['id'],
            'name' => '國美館',
            'address' => '403台中市西區五權西路一段2號',
            'phone' => ' (04)2372-3552',
            'buy_hundred_get_point' => 11,
            'email' => 'karl2015y@gmail.com',
            'description' => '館舍假資料',
            'created_staff_id' => $user['id'],
        ]);
        $museum->save();

        // 新增至Shop表
        $shop = new Shop([
            'museum_id' => $museum['id'],
            'user_id' => $user['id'],
            'name' => '50藍',
            'phone' => '0412345678',
            'description' => '商家假資料',
            'created_staff_id' => $user['id'],
        ]);
        $shop->save();

        // 新增至KnowledgeActivity表
        $ka = new KnowledgeActivity([
            'museum_id' => $museum['id'],
            'name' => '很好玩的活動',
            'start_at' =>  Carbon::now(),
            'end_at' =>  Carbon::now()->addWeek(),
            'point' => 13,
            'point_cycle_hour' => 24,
            'point_cycle_min' => 5,
            'description' => '知識點活動假資料',
            'created_staff_id' => $user['id'],
        ]);
        $ka->save();

    }
}
