@extends('phone.layout.type2')
@section('title', '忘記密碼')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <span class="text-xl font-medium">重設密碼</span>

</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

<div class="mx-10">
    <form action="" method="post">
        @csrf
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>新密碼</div>
        <input name="password" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>確認新密碼</div>
        <input name="password_confirmation" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">

    
        <button class="my-6 w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">重置</button>
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