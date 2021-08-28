@extends('phone.layout.type2')
@section('title', '民眾登入')
@section('content')
<div class="mt-20 mb-10 px-12">
    <img class="w-full h-full" src="/asset/img/logo-row.png" alt="橫向logo">
</div>
<form action="{{route('MemberLogin')}}" method="post" class="px-10">
    @csrf
    <div class="flex justify-end items-center pr-1.5 text-gray-400 ">
        <input class="mt-1 mr-1" type="checkbox" name="remember_me" id="rememberme">
        <label for="rememberme">記住我</label>
    </div>
    <input value="{{ old('email') }}" name="email" class=" shadow-inner mt-1 mb-10 w-full bg-gray-100 p-2.5 rounded" type="text" placeholder="電子信箱">
    <input name="password" class="shadow-inner mb-1 w-full bg-gray-100 p-2.5 rounded" type="password" placeholder="密碼">
    <div class="flex justify-end items-center pr-1.5 text-gray-400 ">
        <a href="{{route('MemberForgetPassPage')}}">忘記密碼？</a>
    </div>
    <div class="mt-6 mb-10">
        <button
            class="w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">登入</button>
    </div>
    <div class="text-center text-gray-400">
        還不是會員？<a href="{{route('MemberRegisterPage')}}"><span class="text-color-third font-bold">註冊會員</span></a>
    </div>
</form>
@stop