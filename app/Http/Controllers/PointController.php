<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 觸及資料庫
use App\Models\Qrcode;

use function Matrix\trace;

class PointController extends Controller
{
    public function getPoint($uuid, Request $request)
    {
        $member = $request->user()->Member;
        $qr = Qrcode::where('id', $uuid)->with('ka', 'ppr')->first();
        $now = \Carbon\Carbon::now();
        // return ($qr);
        if ($qr->ka_id) {
            $ka = $qr->ka;
            // 檢查 是否未開始
            if ($ka->start_at > $now) {
                return "活動將在{$ka->start_at}({$ka->start_at->diffForHumans()})後開始";
            }
            // 檢查 是否已過期
            if ($ka->end_at <= $now) {
                return "活動已在{$ka->end_at}({$ka->end_at->diffForHumans()})過期";
            }
            // return ($ka);
            // 檢查週期時間是否未超過
            if ($ka->SomeMemberLatestKnowledgeActivityRecord($member->id)) {
                $latest_KA = $ka->SomeMemberLatestKnowledgeActivityRecord($member->id)->created_at;
                $latest_KA_Temp = clone $latest_KA;
                $ka_cycle_deadline = $latest_KA_Temp->addHours($ka->point_cycle_hour)->addMinutes($ka->point_cycle_min);
                if ($ka_cycle_deadline > $now) {
                    return "已於{$latest_KA}({$latest_KA->diffForHumans()})領取過點數，請於{$ka_cycle_deadline}({$ka_cycle_deadline->diffForHumans()})後再次掃描";
                }
            }
            // 寫入給點紀錄
            $ka->KnowledgeActivityRecord()->create([
                'knowledge_activity_name' => $ka->name,
                'member_id' => $member->id,
                'member_name' => $member->name,
                'point' => $ka->point,
            ]);
            // 給點
            $member->update([
                'knowledge_point' => $member->knowledge_point + $ka->point
            ]);
            return '給點成功';
        } elseif ($qr->ppr_id) {
            $ppr = $qr->ppr;
            // 檢查是否已經給過消費點
            if ($ppr->member_id) {
                return '消費點點數已於' . $ppr->updated_at . "({$ppr->updated_at->diffForHumans()})" . '發放';
            }
            // 檢查是否超過五分鐘
            $deadline = $qr->created_at->addMinutes(5);
            if ($now > $deadline) {
                return '已於' . $deadline . "({$deadline->diffForHumans()})" . '過期';
            }
            // 使消費點發放紀錄跟民眾綁定
            $ppr->update([
                'member_id' => $member->id,
                'member_name' => $member->name,
            ]);
            // 給點
            $member->update([
                'pay_point' => $member->pay_point + $ppr->point
            ]);
            return '給點成功';
        } else {
            return '系統錯誤，請再次嘗試';
            // $message_title = "錯誤";
            // $message_type = "error";
            // $message = "系統錯誤，請再試一次";
            // return redirect()->back()
            //     ->with('message_title', $message_title)
            //     ->with('message_type', $message_type)
            //     ->with('message', $message);

        }
    }


    public function giveMemberPointPage()
    {
        $members = \App\Models\Member::latest();
        $members =  $members->paginate(10);
        $data = [
            'members' => $members
        ];
        // return $data;
        return view('admin.members.MembersPage', $data);
    }

    public function memberPointHistoryPage($member_id)
    {
        $member = \App\Models\Member::where('id', $member_id)->first();
        $KnowledgePointRecords = \App\Models\KnowledgePointRecord::latest()->where('member_id', $member_id)->where('knowledge_activity_id', null);
        $data = [
            'member' => $member,
            'KnowledgePointRecords' => $KnowledgePointRecords->paginate(10)
        ];
        // return $data;
        return view('admin.members.MemberPointHistoryPage', $data);
    }
    public function memberGivePoint($member_id, Request $request)
    {
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'knowledge_activity_name' => 'required',
            'point' => 'required',
        ], [
            'knowledge_activity_name.required' => ':attribute為必填',
            'point.required' => ':attribute為必填',
        ], [
            'knowledge_activity_name' => '給點原由',
            'point' => '給予知識點',
        ]);

        if ($this->memberGivePointMethod(
            $member_id,
            $validatedData['knowledge_activity_name'],
            $validatedData['point']
        )) {
            $message_title = "給點成功";
            $message_type = "success";
            $message = "成功給予{$validatedData['point']}點知識點";
        } else {
            $message_title = "給點失敗";
            $message_type = "error";
            $message = "找不到該民眾的資料";
        }
        return redirect()->route('memberPointHistoryPage', ['member_id' => $member_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    public function memberGivePointMethod($member_id, $knowledge_activity_name, $point)
    {
        // 取得民眾資料
        $member = \App\Models\Member::where('id', $member_id)->first();
        if ($member == null) {
            return false;
        }

        // 給點
        $member->update([
            'knowledge_point' => $member->knowledge_point + $point
        ]);

        // 新增給點紀錄
        $member->KnowledgePointRecord()->create([
            'knowledge_activity_name' => $knowledge_activity_name,
            'member_name' => $member->name,
            'point' => $point,
        ]);

        // 回傳
        return true;
    }
}
