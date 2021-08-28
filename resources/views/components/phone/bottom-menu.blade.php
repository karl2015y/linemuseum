
    <a href="{{route('MemberPointPage')}}">
        <div class="flex flex-col items-center text-sm">
            @if ($focus=='mypoint')
                <img class="w-8 h-8" src="/asset/bottom-menu/mypoint_active.jpg" alt="">
                <span class="text-color-main">我的點數</span>
            @else
                <img class="w-8 h-8" src="/asset/bottom-menu/mypoint_inactive.jpg" alt="">
                <span class="text-gray-400">我的點數</span>
            @endif
        </div>
    </a>
    <a href="{{route('VouchersStorePage')}}">
        <div class="flex flex-col items-center text-sm text-color-main">
            @if ($focus=='shop')          
                <img class="w-5 h-8" src="/asset/bottom-menu/shop_active.jpg" alt="">
                <span class="text-color-main">兌換券商店</span>
            @else
                <img class="w-5 h-8" src="/asset/bottom-menu/shop_inactive.jpg" alt="">
                <span class="text-gray-400">兌換券商店</span>
            @endif
        </div>
    </a>
    <a href="{{route('MemberVouchersPage')}}">
        <div class="flex flex-col items-center text-sm text-gray-400">
            @if ($focus=='myvoucher')
                <img class="w-8 h-8" src="/asset/bottom-menu/myvoucher_active.jpg" alt="">
                <span class="text-color-main">我的兌換券</span>
            @else   
                <img class="w-8 h-8" src="/asset/bottom-menu/myvoucher_inactive.jpg" alt="">
                <span class="text-gray-400">我的兌換券</span>
            @endif
        </div>
    </a>
    <a href="{{route('MemberAccountPage')}}">
        <div class="flex flex-col items-center text-sm text-gray-400">
            @if ($focus=='myaccount')
                <img class="w-8 h-8" src="/asset/bottom-menu/myaccount_active.jpg" alt="">
                <span class="text-color-main">我的帳號</span>
            @else
               <img class="w-8 h-8" src="/asset/bottom-menu/myaccount_inactive.jpg" alt="">
                <span class="text-gray-400">我的帳號</span> 
            @endif
        </div>
    </a>