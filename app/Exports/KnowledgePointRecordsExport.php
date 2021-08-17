<?php

namespace App\Exports;

use App\Models\KnowledgePointRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KnowledgePointRecordsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KnowledgePointRecord::with('KnowledgeActivity.Museum')->get();
    }
    public function headings(): array
    {
        return ["民眾編號", "民眾名稱", "館舍編號", "館舍名稱", "知識點活動編號", "活動名稱", "獲得知識點", "參與時間"];
    }
    public function map($KPR): array
    {
        if ($KPR->knowledge_activity_id) {
            return [
                $KPR->knowledge_activity_id,
                $KPR->knowledge_activity_name,

                $KPR->KnowledgeActivity->Museum->id,
                $KPR->KnowledgeActivity->Museum->name,

                $KPR->member_id,
                $KPR->member_name,
                $KPR->point,
                $KPR->created_at->toDateTimeString(),

            ];
        } else {
            return [
                $KPR->member_id,
                $KPR->member_name,
                0,
                "總管",
                0,
                $KPR->knowledge_activity_name,

                $KPR->point,
                $KPR->created_at->toDateTimeString(),

            ];
        }
    }
}
