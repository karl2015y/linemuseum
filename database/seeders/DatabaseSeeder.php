<?php

namespace Database\Seeders;
use Carbon\Carbon;


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\Museum;
use App\Models\Shop;
use App\Models\KnowledgeActivity;

use App\Models\Member;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // echo 'Create init data'. PHP_EOL;
        // \App\Models\Setting::create([
        //     'singup_get_point' => 59,
        // ]);


        echo 'Create User data'. PHP_EOL;
        $user = \App\Models\User::factory()->make([
            'name' => 'Karl',
            'email' => 'karl2015y@gmail.com',
            'password' => bcrypt('Aa3345678')
        ]);
        $user->save();
        $users = \App\Models\User::factory()->count(39)->create();
        $test_user = \App\Models\Member::factory()->setUserData(1, $user->email)->create([
            'name'=>$user->name,
        ]);




        echo 'Create Staff data'. PHP_EOL;
        \App\Models\Staff::factory()->make([
            'name'=>'Karl',
            'user_id'=>$user->id,
            'email'=>$user->email,
            'status'=>'enable',
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ])->save();

        echo 'Create Museum data'. PHP_EOL;
        \App\Models\Museum::factory()->make([
            'name'=>'國美館',
            'user_id'=>$user->id,
            'email'=>$user->email,
            'status'=>'enable',
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ])->save();


        echo 'Create Shop data'. PHP_EOL;
        $shop = \App\Models\Shop::factory()->create([
            'name'=>'50藍',
            'museum_id'=>1,
            'user_id'=>$user->id,
            'status'=>'enable',
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ]);
        echo 'Create PayPointRecord data'. PHP_EOL;
        \App\Models\PayPointRecord::factory()->count(30)->create([
            'shop_id'=>$shop->id,
            'shop_name'=>$shop->name,
            'member_id'=>$test_user->id,
            'member_name'=>$test_user->name,
        ]);

        echo 'Create KnowledgeActivity data'. PHP_EOL;
        $KA = \App\Models\KnowledgeActivity::factory()->create([
            'name'=>'好玩的活動',
            'museum_id'=>1,
            'status'=>'enable',
            'start_at'=>Carbon::now(),
            'end_at'=>Carbon::now()->addWeeks(1),
            'point_cycle_hour'=>1,
            'point_cycle_min'=>1,
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ]);
        \App\Models\KnowledgeActivity::factory()->make([
            'name'=>'未開始的活動',
            'museum_id'=>1,
            'status'=>'enable',
            'start_at'=>Carbon::now()->addWeeks(1),
            'end_at'=>Carbon::now()->addWeeks(2),
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ])->save();
        \App\Models\KnowledgeActivity::factory()->make([
            'name'=>'已結束的活動',
            'museum_id'=>1,
            'status'=>'enable',
            'start_at'=>Carbon::now()->subWeeks(2),
            'end_at'=>Carbon::now()->subWeeks(1),
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ])->save();

        // echo 'Create KnowledgePointRecord data'. PHP_EOL;
        // \App\Models\KnowledgePointRecord::factory()->count(30)->create([
        //     'knowledge_activity_id' => $KA->id,
        //     'knowledge_activity_name' => $KA->name,
        //     'member_id' => $test_user->id,
        //     'member_name' => $test_user->name,
        // ]);

        echo 'Create Voucher data'. PHP_EOL;
        $vc = \App\Models\Voucher::factory()->create([
            'name'=>'測試用兌換券',
            'status'=>'enable',
            'amount'=>1,
            'created_staff_id'=>$user->id,
            'updated_staff_id'=>$user->id,
        ]);

        echo 'Create MemberUsedVoucherRecord data'. PHP_EOL;
        $VCRs = \App\Models\MemberUsedVoucherRecord::factory()->count(10)->create([
            'voucher_id'=>$vc->id,
            'voucher_name'=>$vc->name,
            'member_id'=>$test_user->id,
            'member_name'=>$test_user->name,
        ]);
        foreach ($VCRs as $vcr) {
            \App\Models\VoucherRecordStatus::factory()->count(3)->create([
                'voucher_record_id' => $vcr->id
            ]);
        }

        echo 'Create others data'. PHP_EOL;
        foreach ($users as $user) {
            if($user->id<=10){
                \App\Models\Staff::factory()->setUserData($user->id, $user->email)->create();
            }else if($user->id<=20){
                \App\Models\Museum::factory()->setUserData($user->id, $user->email)->create();
            }else if($user->id<=30){
                \App\Models\Shop::factory()->setUserData($user->id, $user->email)->create([
                    'museum_id'=>1,
                ]);
            }else if($user->id<=40){
                \App\Models\Member::factory()->setUserData($user->id, $user->email)->create();
            }
        }




        echo 'Create others KnowledgeActivity data'. PHP_EOL;
        \App\Models\KnowledgeActivity::factory()->count(10)->create([
            'museum_id'=>1,
        ]);
        echo 'Create others Voucher data'. PHP_EOL;
        \App\Models\Voucher::factory()->count(3)->create();
        echo 'Create others VoucherWay data'. PHP_EOL;
        \App\Models\VoucherWay::factory()->count(10)->create();
        echo 'Create others KnowledgePointRecord data'. PHP_EOL;
        \App\Models\KnowledgePointRecord::factory()->count(10)->create();




        

        foreach (\App\Models\KnowledgeActivity::all() as $ka) {
            $ka->Qrcode()->create();
        }

        foreach (\App\Models\PayPointRecord::all() as $ppr) {
            $ppr->Qrcode()->create();
        }


        \App\Models\PayPointRecord::factory()->create([
            'shop_id'=>$shop->id,
            'shop_name'=>$shop->name,
            'member_id'=>null,
            'member_name'=>null,
        ])->Qrcode()->create();

    }
}
