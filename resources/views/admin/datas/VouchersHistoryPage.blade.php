@extends('admin.layouts.type1')

@section('classification-name', '數據總攬')
@section('title', '兌換券記錄列表頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li class="text-gray-400">兌換券記錄列表頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <a href="{{route('VouchersHistoryExport')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                匯出Excel
            </button>

        </a>

    </div>
</div>

{{-- 表格區 --}}
{{ $VCRs->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">兌換券名稱</th>
            <th class="whitespace-nowrap">民眾名稱</th>
            <th class="whitespace-nowrap">購買時間</th>
            <th class="whitespace-nowrap">購買方式</th>
            <th class="whitespace-nowrap">兌換券狀態</th>
            <th class="whitespace-nowrap">狀態更新時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($VCRs as $VCR)
        <tr class="bg-white shadow-md">
            <td class="p-3">
                {{ $VCR->id }}
            </td>

            {{-- 兌換券名稱 --}}
            <td class="p-3 text-center">
                {{ $VCR->voucher_name }}
            </td>
            {{-- 民眾名稱 --}}
            <td class="p-3 text-center">
                {{ $VCR->member_name }}
            </td>
            {{-- 購買時間 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $VCR->created_at->toDateTimeString() }}<br>
                    <small>
                        {{ $VCR->created_at->diffForHumans() }}
                    </small>
                </div>
            </td>
            {{-- 購買方式 --}}
            <td class="p-3 text-center">
                消費點：{{ $VCR->pay_point }}<br>
                知識點：{{ $VCR->knowledge_point }}
            </td>
            {{-- 兌換券狀態 --}}
            <td class="p-3 text-center">
                {{ ['unused'=>'未使用','used'=>'已使用','pass'=>'已過期'][strval($VCR->VoucherRecordStatus->status)] }}
            </td>
            {{-- 狀態更新時間 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $VCR->VoucherRecordStatus->created_at->toDateTimeString() }}<br>
                    <small>
                        {{ $VCR->VoucherRecordStatus->created_at->diffForHumans() }}
                    </small>
                </div>
            </td>


        </tr>
        @endforeach
    </tbody>
</table>
{{ $VCRs->links() }}


<style>
    .table {
        border-spacing: 0 15px;
    }

    i {
        font-size: 1rem !important;
    }

    .table tr {
        border-radius: 20px;
    }

    tr td:nth-child(n+8),
    tr th:nth-child(n+8) {
        border-radius: 0 .625rem .625rem 0;
    }

    tr td:nth-child(1),
    tr th:nth-child(1) {
        border-radius: .625rem 0 0 .625rem;
    }
</style>


@stop

@section('JS-content')

@stop