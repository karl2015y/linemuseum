<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Staff;


class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //指定工廠關聯的model及運行次數
        // factory(Staff::class, 1)->create();
        // Staff::reguard(); //解除模型的批量填充限制
                // 新增至User表
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
                    'description' => '簡介'
                ]);
                $staff['created_staff_id'] =  $user['id'];
                $staff->save();
    }
}
