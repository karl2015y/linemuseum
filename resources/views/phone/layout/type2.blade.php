<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WGR9ZDQ');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/app.css') }}?ver=20211018A" rel="stylesheet">
    <link rel="stylesheet" href="/css/design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <title>@yield('title')</title>

</head>
<style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
    }
</style>

<body class="h-100 overflow-hidden relative">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WGR9ZDQ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="scrolldiv" class="h-full overflow-scroll">
        @yield('content')
    </div>

    <div id="model" class="hidden h-100 bg-black bg-opacity-30 fixed flex items-center justify-center top-0 w-full">
        @yield('model-content')
    </div>
    
</body>

<script>
    function safariHacks() {
        let windowsVH = window.innerHeight / 100;
        document.querySelector('.h-100').style.setProperty('--vh', windowsVH + 'px');
        window.addEventListener('resize', function() {
            document.querySelector('.h-100').style.setProperty('--vh', windowsVH + 'px');
        });
    }
    safariHacks();
    const _model = document.querySelector("#model");
    _model.addEventListener('click',(e)=>{
        if(e.target.id=='model'){modelToggle();}
    })
    window.modelToggle = ()=>{_model.classList.toggle('hidden')};
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('message') && session('message_type') && session('message_title'))
<script type="text/javascript">
Swal.fire({
    title: "{{session('message_title')}}",
    text: "{{session('message')}}",
    /* @if ( str_contains(session('message_type'), '-')) { */
    icon: "{{ explode('-', session('message_type'))[1] }}",
    showConfirmButton: true,
    /* @else */
    icon: "{{session('message_type')}}",
    showConfirmButton: false,
    timer: 1500
    /* @endif */
})
</script>
@endif


@if ($errors->any())

<script type="text/javascript">
Swal.fire({
    title: "錯誤",
    text: "{{$errors->first()}}",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
})
</script>
</div>
@endif


@yield('js-content')
</html>