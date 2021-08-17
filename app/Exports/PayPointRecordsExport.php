<?php

namespace App\Exports;

use App\Models\PayPointRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PayPointRecordsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PayPointRecord::where('member_id','<>','')->with('Shop.Museum')->get();
    }
    public function headings(): array
    {
        return ["民眾編號", "民眾名稱", "館舍編號", "館舍名稱", "商店編號", "商店名稱", "消費金額", "獲得消費點", "消費時間"];
    }
    public function map($PPR): array
    {
        return [
            $PPR->member_id,
            $PPR->member_name,

            $PPR->Shop->Museum->id,
            $PPR->Shop->Museum->name,

            $PPR->shop_id,
            $PPR->shop_name,
            $PPR->price,
            $PPR->point,
            $PPR->created_at->toDateTimeString(),
           
        ];
    }
}
