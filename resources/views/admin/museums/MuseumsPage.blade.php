@extends('admin.layouts.type1')

@section('classification-name', '館舍管理')
@section('title', '館舍列表頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  {{-- 麵包屑 --}}
  <nav class="col-span-2">
    <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
      {{-- <li><a href="#" class="no-underline ">Home</a></li>
      <li class="px-2">/</li>
      <li><a href="#" class="no-underline text-blue-600">Library</a></li>
      <li class="px-2">/</li> --}}
      <li class="text-gray-400">館舍列表頁</li>
    </ol>
  </nav>

  {{-- 按鍵區 --}}
  <div class="w-100 text-right mb-2 md:mb-0">
    <a href="{{route('CreateMuseumPage')}}">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
        新增館舍
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
      <input type="radio" name="status" value="OnlyEnable" id="OnlyEnable" hidden />
      <label for="OnlyEnable"
        class="rounded-l-lg  border border-double border-r-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
        不顯示封存
      </label>
    </div>
    <div class="inline-flex ">
      <input type="radio" name="status" value="ShowDisable" id="ShowDisable" hidden />
      <label for="ShowDisable"
        class="rounded-r-lg border border-double border-l-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
        顯示封存
      </label>
    </div>
  </div>
</form>

{{-- 表格區 --}}
{{ $museums->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
  <thead class="text-gray-100 bg-gray-400">
    <tr>
      <th class="py-0.5">#</th>
      <th>人員名稱</th>
      <th>建立時間</th>
      <th>人員狀態</th>
      <th>建立人員</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($museums as $museum)
    <tr class="bg-white shadow-md">
      <td class="p-3">
        {{ $museum->id }}
      </td>
      {{-- 人員名稱	 --}}
      <td class="p-3">
        <div class="flex align-items-center">
          <div class="ml-3">
            <div class="">{{ $museum->name }}</div>
            <div class="text-gray-500">{{ $museum->email }}</div>
          </div>
        </div>
      </td>
      {{-- 建立時間 --}}
      <td class="p-3 text-center">
        <div class="mt-3">
          {{ $museum->created_at->diffForHumans() }}
        </div>
      </td>
      {{-- 人員狀態 --}}
      <td class="p-3 text-center">
        @if($museum['status']=='enable')
        <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
        @else
        <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span>
        @endif
      </td>
      {{-- 建立人員名稱	 --}}
      <td class="p-3">
        <div class="flex align-items-center">
          <div class="ml-3">
            @if ($museum->CreatedStaff == null)
            <div class="">無</div>
            @else
            <div class=""> {{$museum->CreatedStaff->name}}</div>
            <div class="text-gray-500">{{ $museum->CreatedStaff->email }}</div>
            @endif
          </div>
        </div>
      </td>
      {{-- 操作 --}}
      <td class="p-3 text-center">
        <a href="{{route('MuseumPage', ['museum_id'=>$museum->id ])}}" class="text-gray-800 hover:text-gray-400 mr-2">
          <i class="material-icons-outlined text-base">visibility</i>
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $museums->links() }}


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

  tr td:nth-child(n+6),
  tr th:nth-child(n+6) {
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
// 檢查URL的Query是否包含ShowDisable，是就要切過去
const ShowDisable = document.querySelector("form input#ShowDisable").parentElement.querySelector("label")
const OnlyEnable = document.querySelector("form input#OnlyEnable").parentElement.querySelector("label")
if(getUrlParameter("status")=='ShowDisable'){
  ShowDisable.click()
}else{
  OnlyEnable.click()
}
ShowDisable.addEventListener("click",()=>{
  setTimeout(() => {
    document.querySelector("#changeTableStatus").click()
  }, 100);
})
OnlyEnable.addEventListener("click",()=>{
  setTimeout(() => {
    document.querySelector("#changeTableStatus").click()
  }, 100);
})

</script>
@stop


