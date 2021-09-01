@extends('phone.layout.type2')
@section('title', '商家登入')
@section('content')
<div class="mt-20 mb-10 px-12">
    <img class="w-full h-full" src="/asset/img/logo-row.png" alt="橫向logo">
</div>
<form action="{{route('ShopLogin')}}" method="post" class="px-10">
    @csrf
    <div class="flex justify-end items-center pr-1.5 text-gray-400 ">
        <input class="mt-1 mr-1" type="checkbox"  name="remember_me" id="rememberme">
        <label for="rememberme">記住我</label>
    </div>
    <input value="{{ old('phone') }}" name="phone" class=" shadow-inner mt-1 mb-10 w-full bg-gray-100 p-2.5 rounded" type="text" placeholder="商家登記連絡電話">
    <input name="password" class="shadow-inner mb-1 w-full bg-gray-100 p-2.5 rounded" type="password" placeholder="密碼">
    <div class="flex justify-end items-center pr-1.5 text-gray-400 ">
        <a href="javascript:forgotpassword();" >忘記密碼？</a>
    </div>
    <div class="mt-6 mb-10">
        <button
            class="w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">登入</button>
    </div>
</form>
@stop


@section('js-content')
<script>
    const forgotpassword = ()=>{
        Swal.fire({
            icon: 'info',
            title: '忘記密碼？',
            text: "請聯絡總管工作人員，核實身分後，由後台統一做修改，謝謝。",
            confirmButtonText: '確定'
        })
    }
</script>
@stop
