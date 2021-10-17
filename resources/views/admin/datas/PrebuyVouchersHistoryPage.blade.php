@extends('admin.layouts.type1')

@section('classification-name', '數據總攬')
@section('title', '預購卷記錄列表頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li class="text-gray-400">預購卷記錄列表頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0 flex gap-1.5 flex-col">
        <a href="{{route('PrebuyVouchersAllExport')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                匯出全部訂單Excel
            </button>

        </a>
        <a href="{{route('PrebuyVouchersExport')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                匯出『準備中』訂單Excel
            </button>

        </a>

    </div>
</div>

{{-- 篩選器 --}}
<style>
    input[name=status]:checked~.radio {
      color: white;
      background-color: rgba(59, 130, 246, 1);
      --tw-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
      box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
      font-weight: 700;
    }
  </style>
  <form action="" method="get">
    <input class="hidden" id="changeTableStatus" type="submit" value="">
    <div class="flex text-sm">
      <div class="inline-flex ">
        <input type="radio" name="status" value="OnlyReady" id="OnlyReady" hidden />
        <label for="OnlyReady"
          class="rounded-l-lg  border border-double border-r-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
          僅『準備中』訂單
        </label>
      </div>
      <div class="inline-flex ">
        <input type="radio" name="status" value="ShowOut" id="ShowOut" hidden />
        <label for="ShowOut"
          class="rounded-r-lg border border-double border-l-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
          顯示全部訂單
        </label>
      </div>
    </div>
  </form>

{{-- 表格區 --}}
{{ $VCRs->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">預購卷名稱</th>
            <th class="whitespace-nowrap">民眾名稱</th>
            <th class="whitespace-nowrap">購買時間</th>
            <th class="whitespace-nowrap">購買方式</th>
            <th class="whitespace-nowrap">預購卷狀態</th>
            <th class="whitespace-nowrap">狀態更新時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($VCRs as $VCR)
        <tr class="bg-white shadow-md">
            <td class="p-3 text-center">
                {{ $VCR->id }}
            </td>

            {{-- 預購卷名稱 --}}
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
            {{-- 預購卷狀態 --}}
            <td class="p-3 text-center">
                <div>
                    {{ $VCR->pvr_current_status }}
                </div>
                @if ($VCR->pvr_current_status=="準備中")
                <a href="{{route('PrebuyVoucherPage', $VCR->pvr_id)}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0.5 px-2 rounded text-sm">
                        已寄出
                    </button>
                </a> 
                @else
                <a href="{{route('PrebuyVoucherPage', $VCR->pvr_id)}}">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-0.5 px-2 rounded text-sm">
                        寄出明細
                    </button>
                </a> 
                @endif

            </td>
            {{-- 狀態更新時間 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $VCR->pvr_updated_at->toDateTimeString() }}<br>
                    <small>
                        {{ $VCR->pvr_updated_at->diffForHumans() }}
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

<script type="text/javascript">
// 檢查URL的Query是否包含ShowOut，是就要切過去
const ShowOut = document.querySelector("form input#ShowOut").parentElement.querySelector("label")
const OnlyReady = document.querySelector("form input#OnlyReady").parentElement.querySelector("label")
if(getUrlParameter("status")=='ShowOut'){
  ShowOut.click()
}else{
  OnlyReady.click()
}
ShowOut.addEventListener("click",()=>{
  setTimeout(() => {
    document.querySelector("#changeTableStatus").click()
  }, 100);
})
OnlyReady.addEventListener("click",()=>{
  setTimeout(() => {
    document.querySelector("#changeTableStatus").click()
  }, 100);
})

</script>
@stop