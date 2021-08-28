@extends('phone.layout.type2')
@section('title', '忘記密碼')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('MemberLogin')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>

    <span class="text-xl font-medium">忘記密碼</span>

</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

<div class="mx-10">
    <form action="{{route('MemberForgetPass')}}" method="post">
        @csrf
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>電子信箱(帳號)</div>
        <input placeholder="註冊時填寫的電子信箱" name="name" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="email">

    
        <button class="my-6 w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">傳送重置信件</button>
    </form>


</div>


@stop



@section('js-content')
<script>
    // 上面toptitle
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
</script>


@stop