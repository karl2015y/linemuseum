@extends('phone.layout.type2')
@section('title', '後台登入')
@section('content')
<div class="flex h-full">
    <div class="mt-20 mb-10 px-12 flex justify-center items-center w-full">
        <img src="/asset/img/logo-row.png" alt="橫向logo">
    </div>
    <form action="{{route('AdminLogin')}}" method="post" class="px-10 flex flex-col justify-center w-1/3">
        @csrf
        <div class="flex justify-end items-center pr-1.5 text-gray-400 ">
            <input class="mt-1 mr-1" type="checkbox" name="remember_me" id="rememberme">
            <label for="rememberme">記住我</label>
        </div>
        <input value="{{ old('email') }}" name="email"  class="shadow-inner mt-1 mb-10 w-full bg-gray-100 p-2.5 rounded" type="text" placeholder="電子信箱">
        <input name="password" class="shadow-inner mb-1 w-full bg-gray-100 p-2.5 rounded" type="password" placeholder="密碼">

        <div class="mt-6 mb-10">
            <button
                class="w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">登入</button>
        </div>

    </form>
</div>
@stop