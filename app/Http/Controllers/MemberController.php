<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 觸及資料庫
use App\Models\User;
use App\Models\Member;
use App\Models\Voucher;
use App\Models\Museum;

use Carbon\Carbon;



class MemberController extends Controller
{
    public function MemberLoginPage()
    {
        return view('phone.member.LoginPage');
    }
    public function MemberLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => ':attribute為必填',
            'email.email' => ':attribute格式錯誤',
            'password.required' => ':attribute為必填',
        ], [
            'email' => '電子信箱',
            'password' => '密碼',
        ]);


        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            $message_title = "登入成功";
            $message_type = "success";
            $message = "歡迎回來";
            return redirect()->route('MemberPointPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        } else {
            $message_title = "登入失敗";
            $message_type = "error";
            $message = "帳號或密碼錯誤";
            return redirect()->route('MemberLoginPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }
    public function MemberForgetPassPage(Request $request)
    {
        // 忘記密碼頁
        return view('phone.member.MemberForgetPassPage');
    }
    public function MemberForgetPass(Request $request)
    {
        //  忘記密碼
        $validatedData = $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => ':attribute為必填',
            'email.email' => ':attribute的格式錯誤'
        ], [
            'email' => '電子信箱(帳號)',
        ]);
        //寄 email
        $member = Member::where('email', $validatedData['email'])->first();
        // 確認是否存在在Member表裡
        if ($member) {
            $details = [
                'title' => '很遺憾您遺失了密碼，但沒關係，點擊下方連結，換個密碼再重新登入吧',
                'member_id' => $member->id,
                'created_at' => $member->created_at
            ];
            \Illuminate\Support\Facades\Mail::to($validatedData['email'])->send(new \App\Mail\ResetPassword($details));
        }
        $message_title = "成功";
        $message_type = "success";
        $message = "已將重設密碼之連結寄至您填寫的email，請查收，若沒收到，請確定填寫信箱是否正確";
        return redirect()->route('MemberLoginPage')
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    public function MemberResetPasswordPage()
    {
        return view('phone.member.MemberResetPasswordPage');
    }
    public function MemberResetPassword($member_id, $created_at, Request $request)
    {
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ], [
            'password.required' => ':attribute為必填',
            'password.confirmed' => ':attribute重複錯誤'
        ], [
            'password' => '新密碼',
        ]);
        $member = Member::where('id', '=', $member_id)->first();
        if ($member && $member->created_at == $created_at) {
            $member->User()->update([
                'password' => bcrypt($validatedData['password'])
            ]);
            $message_title = "更新成功";
            $message_type = "success";
            $message = "趕快輸入帳號密碼登入吧~";
            return redirect()->route('MemberLoginPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        } else {
            $message_title = "驗證失敗";
            $message_type = "error";
            $message = "實在很抱歉，發生未知的錯誤，請聯絡管理員，並告知您的email";
            return redirect()->route('MemberLoginPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }

    public function MemberRegisterPage()
    {
        $museums = Museum::latest()->where('status', 'enable')->get();
        $data = [
            'museums' => $museums
        ];
        return view('phone.member.MemberRegisterPage', $data);
    }
    public function MemberRegister(Request $request)
    {
        // 驗證規則
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            "year" => "required",
            "month" => "required",
            "address_region" => "required",
            "recommend_museum" => "required",
            "agree_document" => "required",
        ], [
            'email.required' => ':attribute為必填',
            'email.email' => ':attribute的格式錯誤',
            'password.required' => ':attribute為必填',
            'password.confirmed' => ':attribute重複錯誤',
            'name.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
            'gender.required' => ':attribute為必填',
            'year.required' => ':attribute為必填',
            'month.required' => ':attribute為必填',
            'address_region.required' => ':attribute為必填',
            'recommend_museum.required' => ':attribute為必填',
            'agree_document.required' => '須同意條款才能進行註冊',

        ], [
            'email' => '電子信箱(帳號)',
            'password' => '密碼',
            'name' => '名稱/暱稱',
            'phone' => '連絡電話',
            'gender' => '性別',
            "year" => "出生年",
            "month" => "出生月",
            "address_region" => "居住區域",
            "recommend_museum" => "推薦館舍",
        ]);
        // 確認是否存在在Member表裡
        if (Member::where('email', $validatedData['email'])->first()) {
            $message_title = "註冊失敗";
            $message_type = "error";
            $message = "此email已註冊過";
            return redirect()->route('MemberRegisterPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
        // 確認是否存在在User表裡
        $user = User::where('email', $validatedData['email'])->first();
        if ($user == NULL) {
            // 新增至User表
            $user = new User([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'])
            ]);
            $user->save();
        }
        // 新增至Member表
        $member = Member::create([
            'user_id' => $user['id'],
            'gender' => $validatedData['gender'],
            'year' => $validatedData['year'],
            'month' => $validatedData['month'],
            'name' => $validatedData['name'],
            'address_region' => $validatedData['address_region'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'recommend_museum' => $validatedData['recommend_museum'],
        ]);

        $details = [
            'title' => '恭喜註冊成功，點擊下方連結，啟用帳號吧',
            'member_id' => $member->id,
            'created_at' => $member->created_at
        ];

        //寄 email
        \Illuminate\Support\Facades\Mail::to($validatedData['email'])->send(new \App\Mail\VerifyMail($details));


        $message_title = "註冊成功";
        $message_type = "confirm-success";
        $message = "請至email驗證註冊資訊，來獲得註冊禮";
        return redirect()->route('MemberLoginPage')
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
        // 新增用戶

        return redirect()->route('MemberLoginPage');
    }
    public function MemberVerifyMail($member_id, $created_at)
    {
        $member = Member::where('id', '=', $member_id)->first();
        if ($member && $member->created_at == $created_at) {
            if ($member->User->email_verified_at) {
                $message_title = "重複驗證";
                $message_type = "success";
                $message = "已在{$member->User->email_verified_at}完成驗證，趕快輸入帳號密碼登入吧~";
                return redirect()->route('MemberLoginPage')
                    ->with('message_title', $message_title)
                    ->with('message_type', $message_type)
                    ->with('message', $message);
            }
            $member->User()->update([
                'email_verified_at' => Carbon::now()
            ]);

            // 給予點數
            $setting = \App\Models\Setting::where('id', 1)->first();
            $PC = new \App\Http\Controllers\PointController;
            $PC->memberGivePointMethod($member_id, "註冊成功", $setting['singup_get_point']);


            $message_title = "驗證成功";
            $message_type = "success";
            $message = "趕快輸入帳號密碼登入吧~";
            return redirect()->route('MemberLoginPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        } else {
            $message_title = "驗證失敗";
            $message_type = "error";
            $message = "實在很抱歉，發生未知的錯誤，請聯絡管理員，並告知您的email";
            return redirect()->route('MemberLoginPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }
    public function MemberPointPage(Request $request)
    {
        $datas = [
            'member' => $request->user()->Member
        ];
        // return $datas;
        return view('phone.member.MemberPointPage', $datas);
    }
    public function MemberPayHistoryPage(Request $request)
    {
        $datas = [
            'PPRs' => $request->user()->Member->PayPointRecord()->with('Shop.Museum')->latest()->paginate(10)
        ];
        return view('phone.member.MemberPayHistoryPage', $datas);
    }
    public function MemberKAHistoryPage(Request $request)
    {
        $datas = [
            'KPRs' => $request->user()->Member->KnowledgePointRecord()->with('KnowledgeActivity.Museum')->latest()->paginate(10)
        ];
        // return $datas;
        return view('phone.member.MemberKAHistoryPage', $datas);
    }
    public function MemberAccountPage(Request $request)
    {
        $datas = [
            'member' => $request->user()->Member
        ];
        // return $datas;
        return view('phone.member.MemberAccountPage',  $datas);
    }
    public function EditMemberAccountPage(Request $request)
    {
        $datas = [
            'member' => $request->user()->Member
        ];
        return view('phone.member.EditMemberAccountPage',  $datas);
    }
    public function EditMemberAccount(Request $request)
    {
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
        ], [
            'name' => '名稱/暱稱',
            'phone' => '連絡電話',
        ]);
        $request->user()->Member->update($validatedData);


        return redirect()->route('MemberAccountPage');
    }

    // 兌換券商店
    public function VouchersStorePage()
    {
        $now = Carbon::now();
        $vouchers = Voucher::where([
            ['start_at', '<=', $now],
            ['end_at', '>', $now],
            ['status', '=', 'enable'],
            ['amount', '>=', 1]
        ])->get();
        $datas = [
            'vouchers' => $vouchers
        ];
        // return $datas;
        return view('phone.member.voucherstore.VouchersStorePage', $datas);
    }
    // 兌換券商店單頁
    public function VoucherStorePage($voucher_id, Request $request)
    {
        if ($request->user()) {
            $member = $request->user()->member;
        } else {
            $member = null;
        }
        $now = Carbon::now();
        $voucher = Voucher::where([
            ['id', '=', $voucher_id],
            ['start_at', '<=', $now],
            ['end_at', '>', $now],
            ['status', '=', 'enable'],
            ['amount', '>=', 1]
        ])->with('VoucherWay')->first();
        if ($voucher == null) {
            $message_title = "兌換券資料失敗";
            $message_type = "error";
            $message = "查無該兌換券";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
        foreach ($voucher->VoucherWay as $vw) {
            if ($member) {
                if ($vw->pay_point <= $member->pay_point && $vw->knowledge_point <= $member->knowledge_point) {
                    $vw['can_buy'] = true;
                } else {
                    $vw['can_buy'] = false;
                }
            } else {
                $vw['can_buy'] = false;
            }


            if ($vw->pay_point > 0 && $vw->knowledge_point > 0) {
                $vw['text'] = "知識點{$vw->knowledge_point}點 + 消費點{$vw->pay_point}點";
            } else {
                if ($vw->pay_point > 0) {
                    $vw['text'] = "消費點{$vw->pay_point}點";
                } else {
                    $vw['text'] = "知識點{$vw->knowledge_point}點";
                }
            }
        }

        $datas = [
            'member' => $member,
            'voucher' => $voucher
        ];
        // return $datas;
        return view('phone.member.voucherstore.VoucherStorePage', $datas);
    }

    // 購買預購兌換券頁
    public function BuyPreVoucherPage($voucher_id, Request $request)
    {
        // 確定一下點數是否夠
        $member = $request->user()->member;
        $now = Carbon::now();
        $vw_id = $request->input('voucher_way_id');
        $voucher = Voucher::where([
            ['id', '=', $voucher_id],
            ['start_at', '<=', $now],
            ['end_at', '>', $now],
            ['status', '=', 'enable'],
            ['amount', '>=', 1]
        ])->first();
        if ($voucher == null) {
            $message_title = "購券失敗 - 1";
            $message_type = "error";
            $message = "請重新嘗試購買";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        };
        $voucher_way = $voucher->VoucherWay->where('id', $vw_id)->first();
        if ($voucher_way == null || ($member->knowledge_point - $voucher_way->knowledge_point) < 0 ||  ($member->pay_point - $voucher_way->pay_point) < 0) {
            $message_title = "購券失敗 - 2";
            $message_type = "error";
            $message = "請重新嘗試購買";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        };
        if ($voucher_way->pay_point > 0 && $voucher_way->knowledge_point > 0) {
            $voucher_way['text'] = "知識點{$voucher_way->knowledge_point}點 + 消費點{$voucher_way->pay_point}點";
        } else {
            if ($voucher_way->pay_point > 0) {
                $voucher_way['text'] = "消費點{$voucher_way->pay_point}點";
            } else {
                $voucher_way['text'] = "知識點{$voucher_way->knowledge_point}點";
            }
        }
        $datas = [
            'voucher' => $voucher,
            'voucher_way' => $voucher_way,
            'last_PVR' =>$request->user()->PreVoucherRecord()->first()
        ];
        // return $datas;
        return view('phone.member.voucherstore.BuyPreVoucherPage', $datas);
    }
    // 購買預購兌換券頁
    public function BuyPreVoucher($voucher_id, Request $request){
        $member = $request->user()->member;
        $now = Carbon::now();
        $vw_id = $request->input('voucher_way_id');
        $voucher = Voucher::where([
            ['id', '=', $voucher_id],
            ['start_at', '<=', $now],
            ['end_at', '>', $now],
            ['status', '=', 'enable'],
            ['amount', '>=', 1]
        ])->first();
        $voucher_way = $voucher->VoucherWay->where('id', $vw_id)->first();
        if ($voucher == null ||  $voucher_way == null || ($member->knowledge_point - $voucher_way->knowledge_point) < 0 ||  ($member->pay_point - $voucher_way->pay_point) < 0) {
            $message_title = "購券失敗";
            $message_type = "error";
            $message = "請重新嘗試購買";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        };

        // 扣除券的數量
        $voucher->update(['amount' => $voucher->amount - 1]);
        // 扣民眾的錢
        $member->update([
            'knowledge_point' => $member->knowledge_point - $voucher_way->knowledge_point,
            'pay_point' => $member->pay_point - $voucher_way->pay_point,
        ]);
        // 將購券資訊存入我的兌換券中
        $vcr = $member->VoucherRecord()->create([
            'voucher_id' => $voucher->id,
            'voucher_name' => $voucher->name,
            'member_name' => $member->name,
            'pay_point' => $voucher_way->pay_point,
            'knowledge_point' => $voucher_way->knowledge_point,
            'start_at' => $voucher->start_at,
            'end_at' => $voucher->end_at,
            'description' => $voucher->description,
            'pic_1' => $voucher->pic_1,
            'Pic_2' => $voucher->Pic_2,

        ]);
        $vcr->VoucherRecordStatus()->create();
        
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ], [
            'name.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
            'email.required' => ':attribute為必填',
            'address.required' => ':attribute為必填',
        ], [
            'name' => '收件人姓名',
            'phone' => '收件人手機號碼',
            'emai' => '電子信箱',
            'addressl' => '完整收件地址',
        ]);
        $vcr->PreVoucherRecord()->create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'status_list' => "<li>".Carbon::now()." -> 準備中</li>",
            'voucher_id' => $voucher->id,
            'user_id' => $request->user()->id,
        ]);


        if ($voucher_way->pay_point > 0 && $voucher_way->knowledge_point > 0) {
            $voucher_way['text'] = "知識點{$voucher_way->knowledge_point}點 + 消費點{$voucher_way->pay_point}點";
        } else {
            if ($voucher_way->pay_point > 0) {
                $voucher_way['text'] = "消費點{$voucher_way->pay_point}點";
            } else {
                $voucher_way['text'] = "知識點{$voucher_way->knowledge_point}點";
            }
        }
        $datas = [
            'voucher' => $voucher,
            'voucher_way' => $voucher_way,
        ];
        return view('phone.member.voucherstore.BoughtPreVoucherPage', $datas);
    }



    // 購買兌換券
    public function BuyVoucher($voucher_id, Request $request)
    {
        $member = $request->user()->member;
        $now = Carbon::now();
        $vw_id = $request->input('voucher_way_id');
        $voucher = Voucher::where([
            ['id', '=', $voucher_id],
            ['start_at', '<=', $now],
            ['end_at', '>', $now],
            ['status', '=', 'enable'],
            ['amount', '>=', 1]
        ])->first();
        $voucher_way = $voucher->VoucherWay->where('id', $vw_id)->first();
        if ($voucher == null ||  $voucher_way == null || ($member->knowledge_point - $voucher_way->knowledge_point) < 0 ||  ($member->pay_point - $voucher_way->pay_point) < 0) {
            $message_title = "購券失敗";
            $message_type = "error";
            $message = "請重新嘗試購買";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        };

        // 扣除券的數量
        $voucher->update(['amount' => $voucher->amount - 1]);
        // 扣民眾的錢
        $member->update([
            'knowledge_point' => $member->knowledge_point - $voucher_way->knowledge_point,
            'pay_point' => $member->pay_point - $voucher_way->pay_point,
        ]);
        // 將購券資訊存入我的兌換券中
        $vcr = $member->VoucherRecord()->create([
            'voucher_id' => $voucher->id,
            'voucher_name' => $voucher->name,
            'member_name' => $member->name,
            'pay_point' => $voucher_way->pay_point,
            'knowledge_point' => $voucher_way->knowledge_point,
            'start_at' => $voucher->start_at,
            'end_at' => $voucher->end_at,
            'description' => $voucher->description,
            'pic_1' => $voucher->pic_1,
            'Pic_2' => $voucher->Pic_2,

        ]);
        $vcr->VoucherRecordStatus()->create();
        $message_title = "購買成功";
        $message_type = "success";
        $message = "前往我的兌換券查看兌換券資訊";
        return redirect()->route('VouchersStorePage')
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
}
