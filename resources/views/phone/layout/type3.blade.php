<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <title>@yield('title')</title>

</head>
<style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
    }
</style>

<body class="h-100 overflow-hidden relative">
    <div id="scrolldiv" class="h-full overflow-scroll">
        <div id="app" class="h-full ">
            @yield('content')
        </div>
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