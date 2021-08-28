@extends('phone.layout.type2')
@section('title', '編輯個人資料')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('MemberAccountPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>

    <span class="text-xl font-medium">編輯個人資料</span>

    <span id="submit_edit" class="absolute right-5 bottom-2 text-color-main">儲存</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

<div class="mx-10">
    <form action="{{route('EditMemberAccount')}}" method="post">
        @csrf
        @method('PUT')
        <div class="mt-6 text-gray-500">名稱/暱稱</div>
        <input value="{{old('name', $member->name)}}" name="name" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">
        <div class="mt-6 text-gray-500">連絡電話</div>
        <input value="{{old('phone', $member->phone)}}" name="phone" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">
        <input class="hidden" type="submit" value="go">
    </form>

</div>

@stop

@section('js-content')
<script>
const _scrolldiv = document.querySelector("#scrolldiv")
const _toptitle = document.querySelector("#toptitle")
const _toptitleSpace = document.querySelector("#toptitleSpace")
_scrolldiv.addEventListener('scroll',(e)=>{
    if(_scrolldiv.scrollTop>=_toptitle.clientHeight/2){
        _toptitle.className = "bg-color-sec fixed py-2 shadow text-center top-0 w-full"
        _toptitleSpace.classList.remove('hidden')
    }else{
        _toptitle.className = "relative text-center  pb-2 pt-12 bg-color-sec"
        _toptitleSpace.classList.add('hidden')
    }
})
document.querySelector('#submit_edit').addEventListener('click',()=>{
    document.querySelector('form input[type=submit]').click()
})

</script>
@stop