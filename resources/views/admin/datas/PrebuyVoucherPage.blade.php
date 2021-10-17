@extends('admin.layouts.type1')

@section('classification-name', '預購卷管理')
@section('title', '寄出預購卷')




@section('content')



<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('PrebuyVouchersHistoryPage')}}" class="no-underline text-blue-600">預購卷記錄列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">寄出預購卷</li>
        </ol>
    </nav>
    @if (!$PVR->member_note)
        {{-- 按鍵區 --}}
        <div class="w-100 text-right mb-2 md:mb-0">
            <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                確定寄出
            </button>
            <a href="{{route('PrebuyVouchersHistoryPage')}}">
                <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                    取消
                </button>
            </a>

        </div>
    @endif
</div>



<form action="{{route('PrebuyVoucher', $PVR->id)}}" method="post">
    @csrf
    <div>
        訂單編號：{{$PVR->VoucherRecord->id}}
        <br>
        預購卷名稱：{{$PVR->VoucherRecord->voucher_name}}
        <br>
        購買時間：{{$PVR->VoucherRecord->created_at}}
        <br>
        訂單狀態：{{$PVR->current_status}}
        <br>
        訂單紀錄：<ul class="pl-6">{!!$PVR->status_list!!}</ul>
        <br>
        收件人名稱：{{$PVR->name}}
        <br>
        收件人信箱：{{$PVR->email}}
        <br>
        收件人地址：{{$PVR->address}}
        <br>
        收件人電話：{{$PVR->phone}}
    </div>
    {{-- 寄出備註 --}}
    @if ($PVR->member_note)
        <div>寄出備註</div>
        <div class="bg-white border border-gray-300 border-solid px-44 py-10 rounded shadow">
            {!!$PVR->member_note!!}
        </div>
    @else
        <div>寄出備註(出貨單單號...之類的) <span class="text-red-500 font-bold">*</span></div>
        <textarea class="hidden" id="textarea_description" name="member_note">

            <google-sheets-html-origin style="text-align:center;"><div style="display: flex;justify-content: center;"><img style="width: 12rem;height: 4.85rem;margin-bottom: 2.5rem;" src="{{request()->getSchemeAndHttpHost()}}/asset/img/logo-row.png" alt=""></div><table border="0" width="100%" cellpadding="0" cellspacing="0"><tbody><tr><th></th><th></th></tr><tr style="border-bottom-width: 1px;border-style: solid;"><td>收件人名稱<br/></td><td style="text-align: right;">{{$PVR->name}}</td></tr><tr style="border-bottom-width: 1px;border-style: solid;"><td >收件人信箱</td><td style="text-align: right;">{{$PVR->email}}</td></tr><tr style="border-bottom-width: 1px;border-style: solid;"><td>收件人地址</td><td style="text-align: right;">{{$PVR->address}}</td></tr><tr style="border-bottom-width: 1px;border-style: solid;"><td>收件人電話</td><td style="text-align: right;">{{$PVR->phone}}</td></tr><tr style="border-bottom-width: 1px;border-style: solid;"><td>出貨單單號</td><td style="text-align: right;"></td></tr><tr><td>備註</td><td style="text-align: right;">無</td></tr></tbody></table><p><br/></p><p><br/></p><p>感謝您的惠顧<br/></p><p><a href="https://lin.ee/UK78HdY" target="_blank">藝點通</a></p></google-sheets-html-origin><div style="text-align:center;"><google-sheets-html-origin><p><a href="https://lin.ee/UK78HdY" target="_blank">https://lin.ee/UK78HdY</a><br/></p></google-sheets-html-origin><div style="display: none;"><div></div></div></div>
        
        </textarea> <br>

        {{-- 送出 --}}
        <input class="hidden" type="submit" value="送出">
    @endif



</form>





@stop


@section('JS-content')
<script type="text/javascript">
    // 富文本
window.createEdit('#textarea_description')
// 綁定按鈕監聽器
document.querySelector("#submit-button").addEventListener('click',()=>{
    document.querySelector("form input[type=submit]").click()
})

</script>


@stop