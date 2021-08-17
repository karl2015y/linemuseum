@extends('admin.layouts.type1')

@section('classification-name', '館舍管理')
@section('title', '知識點活動列表頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  {{-- 麵包屑 --}}
  <nav class="col-span-2">
    <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
      <li><a href="{{route('MuseumPage', ['museum_id'=>$museum->id])}}"
          class="no-underline text-blue-600">{{$museum['name']}}</a></li>
      <li class="px-2">/</li>
      <li><a href="{{route('KnowledgeActivitiesPage',['museum_id'=>$museum->id])}}"
          class="no-underline text-blue-600">知識點活動列表頁</a></li>
      <li class="px-2">/</li>
      <li><a href="{{route('KnowledgeActivityPage',['museum_id'=>$museum->id, 'ka_id'=>$ka->id])}}"
        class="no-underline text-blue-600">{{$ka->name}}</a></li>
      <li class="px-2">/</li>
      <li class="text-gray-400">參與活動列表頁</li>
    </ol>
  </nav>
</div>


{{-- 表格區 --}}
{{ $KPRs->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
  <thead class="text-gray-100 bg-gray-400">
    <tr>
      <th class="py-0.5">#</th>
      <th>活動名稱</th>
      <th>民眾名稱</th>
      <th>獲得知識點</th>
      <th>參與時間</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($KPRs as $KPR)
    <tr class="bg-white shadow-md">
      <td class="p-3 text-center">
        {{ $KPR->id }}
      </td>

      {{-- 活動名稱 --}}
      <td class="p-3 text-center">
        <div class="mt-3">
          {{ $KPR->knowledge_activity_name }}
        </div>
      </td>
      {{-- 民眾名稱 --}}
      <td class="p-3 text-center">
        <div class="mt-3">
          {{ $KPR->member_name }}
        </div>
      </td>
      {{-- 獲得知識點 --}}
      <td class="p-3 text-center">
        <div class="mt-3">
          {{ $KPR->point }} 點
        </div>
      </td>

      {{-- 建立時間 --}}
      <td class="p-3 text-center">
        <div class="mt-3">
          {{ $KPR->created_at->toDateTimeString() }} <br>
          <small>
            {{ $KPR->created_at->diffForHumans() }}
          </small>
        </div>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>
{{ $KPRs->links() }}


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

  tr td:nth-child(n+5),
  tr th:nth-child(n+5) {
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
  const bindRadio = (dom)=>{
  dom.addEventListener("click",()=>{
  setTimeout(() => {
    document.querySelector("#changeTableStatus").click()
  }, 100);
})
}
  // 檢查URL的Query是否包含ShowDisable，是就要切過去
const ShowDisable = document.querySelector("form input#ShowDisable").parentElement.querySelector("label")
const OnlyEnable = document.querySelector("form input#OnlyEnable").parentElement.querySelector("label")
if(getUrlParameter("status")=='ShowDisable'){
  ShowDisable.click()
}else{
  OnlyEnable.click()
}
bindRadio(ShowDisable)
bindRadio(OnlyEnable)

const radio_ing = document.querySelector("form input#ing").parentElement.querySelector("label")
const radio_will = document.querySelector("form input#will").parentElement.querySelector("label")
const radio_done = document.querySelector("form input#done").parentElement.querySelector("label")

const timelineClick = {
  '' : radio_ing,
  'ing' : radio_ing,
  'will' : radio_will,
  'done' : radio_done,
}
timelineClick[getUrlParameter("timeline")].click()

bindRadio(radio_ing)
bindRadio(radio_will)
bindRadio(radio_done)


</script>
@stop