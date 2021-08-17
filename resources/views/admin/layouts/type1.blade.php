<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <title>@yield('title')</title>
    
</head>

<body>
    <div class="relative min-h-screen md:flex">

        <!-- mobile menu bar -->
        <div class="bg-gray-800 text-gray-100 flex md:hidden">
            <!-- mobile menu button -->
            <button class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- logo -->
            <a href="#" class="block p-4 text-white font-bold">Better Dev</a>


        </div>

        <!-- sidebar -->
        <div style="z-index: 60000;"
            class="bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">

            <!-- logo -->
            <div class="flex">
                <a href="/admin" class="text-white flex items-center space-x-2 px-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <span class="text-xl font-extrabold">Better Dev</span>
                    <!-- mobile menu button -->
                </a>
                <button class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700 md:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>



            <!-- nav -->
            <span class="hidden">

                {{ $RN = \Request::route()->getName() }}
            </span>
            <nav>
                <a href="{{route('VouchersPage')}}"
                    class=" @if ($RN=='VouchersPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                   
                    兌換券管理
                </a>
                <a href="{{route('MuseumsPage')}}"
                    class=" @if ($RN=='MuseumsPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    館舍管理
                </a>
                <a href="{{route('StaffsPage')}}"
                    class=" @if ($RN=='StaffsPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    總管人員管理
                </a>
                <a href="{{route('giveMemberPointPage')}}"
                    class="@if ($RN=='giveMemberPointPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    民眾管理(給點)
                </a>
                <div>
                    <span class="block py-2.5 px-4 rounded ">
                        數據總攬
                    </span>
                    <div class="pl-3 shadow-inner bg-blue-700">
                        <a href="{{route('PayPointHistoryPage')}}"
                            class="@if ($RN=='PayPointHistoryPage' || $RN=='KnowledgePointHistoryPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white">
                            點數發放列表
                        </a>

                        <a href="{{route('VouchersHistoryPage')}}"
                            class="@if ($RN=='VouchersHistoryPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white">
                            兌換券紀錄列表
                        </a>

                        <a href="{{route('MembersPage')}}"
                            class=" @if ($RN=='MembersPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white">
                            民眾基本資料列表
                        </a>
                    </div>
                </div>
                <a href="{{route('setConfigPage')}}"
                    class="@if ($RN=='setConfigPage') border-double border-2 @endif block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    系統設定
                </a>
            </nav>
        </div>

        <!-- content -->
        <div class="flex-1 ">
            <div class="flex justify-center min-h-screen bg-gray-100 ">
                <div class="col-span-12 w-11/12 pb-10">
                    <div class="overflow-auto lg:overflow-visible pt-5">
                        <div class="text-3xl font-bold">@yield('classification-name')</div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('JS-content')


    @if (session('message') && session('message_type') && session('message_title'))
    <script type="text/javascript">
        window.createNotification("{{session('message_type')}}", "{{session('message_title')}}" , "{{session('message')}}");
    </script>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $index => $error)
    <script type="text/javascript">
        window.createNotification('error', '新增錯誤', '{{$error}}', '{{$index}}');
    </script>
    @endforeach
    </div>
    @endif
</body>

</html>