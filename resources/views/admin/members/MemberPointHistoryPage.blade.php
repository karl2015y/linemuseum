@extends('admin.layouts.type1')

@section('classification-name', '民眾管理(給點)')
@section('title', '民眾給點頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('giveMemberPointPage')}}" class="no-underline text-blue-600">民眾列表</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">民眾({{$member->name}})給點頁</li>
        </ol>
    </nav>
</div>

<p>
    該民眾目前知識點：{{$member->knowledge_point}}
</p>
<br>
<form action="{{route('memberGivePoint',['member_id'=>$member->id])}}" method="post">
    @csrf
    {{-- 給點原由 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="knowledge_activity_name" name="knowledge_activity_name" value="{{ old('knowledge_activity_name') }}" type="text" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="knowledge_activity_name" class="absolute left-2 transition-all bg-white px-1">
            給點原由 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
 

    {{-- 給予知識點 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="point" name="point" value="{{ old('point') }}" type="number" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="point" class="absolute left-2 transition-all bg-white px-1">
            給予知識點 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>


    {{-- 送出 --}}
    <input type="submit" value="送出" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded"> 


</form>



{{-- 表格區 --}}
{{ $KnowledgePointRecords->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">給點原由</th>
            <th class="whitespace-nowrap">給予知識點</th>
            <th class="whitespace-nowrap">操作時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($KnowledgePointRecords as $KPR)
        <tr class="bg-white shadow-md">
            <td class="p-3  text-center">
                {{ $KPR->id }}
            </td>
            {{-- 給點原由	 --}}
            <td class="p-3 text-center">
                {{ $KPR->knowledge_activity_name }}
            </td>

            {{-- 給予知識點 --}}
            <td class="p-3 text-center">
                {{ $KPR->point }}
            </td>
           
            {{-- 操作時間 --}}
            <td class="p-3 text-center">
                {{$KPR->created_at->toDateTimeString()}}<br>
                <small>
                    ({{$KPR->created_at->diffForHumans()}})
                </small>
            </td>
           

        </tr>
        @endforeach
    </tbody>
</table>
{{ $KnowledgePointRecords->links() }}




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

    tr td:nth-child(n+4),
    tr th:nth-child(n+4) {
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