<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class MembersExport implements FromCollection, WithHeadings, WithMapping
{


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = Member::all();
        // foreach ($datas as $data) {
        //     unset($data["user_id"]);
        //     unset($data["updated_at"]);
        //     $data["register_at"] = $data->created_at->toDateTimeString();
        //     unset($data["created_at"]);
        // }
        // dd($datas);
        return $datas;
    }
    public function headings(): array
    {
        return ["會員編號", "民眾名稱", "聯絡信箱", "連絡電話", "性別", "生日年月", "居住區域", "推薦單位", "消費點", "知識點", "註冊時間"];
    }
    public function map($member): array
    {
        return [
            $member->id,
            $member->name,
            $member->email,
            $member->phone,
            $member->gender=='male'?'男': (($member->gender=='female')?'女':($member->gender)),
            "{$member->year}年{$member->month}月",
            $member->address_region,
            $member->recommend_museum,
            $member->pay_point,
            $member->knowledge_point,
            $member->created_at->toDateTimeString(),
           
        ];
    }
}
