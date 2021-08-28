@extends('phone.layout.type2')
@section('title', '註冊會員')
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

    <span class="text-xl font-medium">註冊會員</span>

</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

<div class="mx-10">
    <form action="{{route('MemberRegister')}}" method="post">
        @csrf
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>電子信箱(帳號)</div>
        <input value="{{old('email')}}" name="email" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="email">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>密碼</div>
        <input name="password" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>確認密碼</div>
        <input name="password_confirmation" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>名稱/暱稱</div>
        <input value="{{old('name')}}" name="name" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>連絡電話</div>
        <input value="{{old('phone')}}" name="phone" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>性別</div>
        <div class="pl-3 mt-2">
            <input value="male" type="radio" name="gender" id="gender_male" {{old('gender')=='male'?'checked':''}}>
            <label for="gender_male">男</label>
            &emsp;
            <input value="female" type="radio" name="gender" id="gender_female" {{old('gender')=='female'?'checked':''}}>
            <label for="gender_female">女</label>
        </div>

        <div class="mt-5 text-gray-500"><span class="text-sm text-red-500">* </span>出生年月</div>
        <div class="w-full flex justify-between">
            <select value="{{old('year')}}" class="mt-2 w-3/5 bg-gray-100 rounded p-1 shadow-inner " id="year" name="year">
                <option disabled selected>西元年</option>
                <option value="1921">1921</option>
                <option value="1922">1922</option>
                <option value="1923">1923</option>
                <option value="1924">1924</option>
                <option value="1925">1925</option>
                <option value="1926">1926</option>
                <option value="1927">1927</option>
                <option value="1928">1928</option>
                <option value="1929">1929</option>
                <option value="1930">1930</option>
                <option value="1931">1931</option>
                <option value="1932">1932</option>
                <option value="1933">1933</option>
                <option value="1934">1934</option>
                <option value="1935">1935</option>
                <option value="1936">1936</option>
                <option value="1937">1937</option>
                <option value="1938">1938</option>
                <option value="1939">1939</option>
                <option value="1940">1940</option>
                <option value="1941">1941</option>
                <option value="1942">1942</option>
                <option value="1943">1943</option>
                <option value="1944">1944</option>
                <option value="1945">1945</option>
                <option value="1946">1946</option>
                <option value="1947">1947</option>
                <option value="1948">1948</option>
                <option value="1949">1949</option>
                <option value="1950">1950</option>
                <option value="1951">1951</option>
                <option value="1952">1952</option>
                <option value="1953">1953</option>
                <option value="1954">1954</option>
                <option value="1955">1955</option>
                <option value="1956">1956</option>
                <option value="1957">1957</option>
                <option value="1958">1958</option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1961">1961</option>
                <option value="1962">1962</option>
                <option value="1963">1963</option>
                <option value="1964">1964</option>
                <option value="1965">1965</option>
                <option value="1966">1966</option>
                <option value="1967">1967</option>
                <option value="1968">1968</option>
                <option value="1969">1969</option>
                <option value="1970">1970</option>
                <option value="1971">1971</option>
                <option value="1972">1972</option>
                <option value="1973">1973</option>
                <option value="1974">1974</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
            </select>
            <select value="{{old('month')}}" class="mt-2 w-1/3 bg-gray-100 rounded p-1 shadow-inner " id="month" name="month">
                <option disabled selected>月份</option>
                <option value="01">一月</option>
                <option value="02">二月</option>
                <option value="03">三月</option>
                <option value="04">四月</option>
                <option value="05">五月</option>
                <option value="06">六月</option>
                <option value="07">七月</option>
                <option value="08">八月</option>
                <option value="09">九月</option>
                <option value="10">十月</option>
                <option value="11">十一月</option>
                <option value="12">十二月</option>
            </select>
        </div>

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>居住區域</div>
        <select class="mt-2 w-full bg-gray-100 rounded p-1 shadow-inner " id="address_select">
            <option disabled selected>居住區域</option>
            <option value="中區">中區</option>
            <option value="東區">東區</option>
            <option value="南區">南區</option>
            <option value="南屯區">南屯區</option>
            <option value="西區">西區</option>
            <option value="西屯區">西屯區</option>
            <option value="北區">北區</option>
            <option value="北屯區">北屯區</option>
            <option value="豐原區">豐原區</option>
            <option value="大里區">大里區</option>
            <option value="大安區">大安區</option>
            <option value="大甲區">大甲區</option>
            <option value="大肚區">大肚區</option>
            <option value="大雅區">大雅區</option>
            <option value="太平區">太平區</option>
            <option value="清水區">清水區</option>
            <option value="沙鹿區">沙鹿區</option>
            <option value="東勢區">東勢區</option>
            <option value="梧棲區">梧棲區</option>
            <option value="烏日區">烏日區</option>
            <option value="神岡區">神岡區</option>
            <option value="后里區">后里區</option>
            <option value="霧峰區">霧峰區</option>
            <option value="潭子區">潭子區</option>
            <option value="龍井區">龍井區</option>
            <option value="外埔區">外埔區</option>
            <option value="和平區">和平區</option>
            <option value="石岡區">石岡區</option>
            <option value="新社區">新社區</option>
            <option value="非臺中區域">非臺中區域</option>
        </select>
        <div id="address_div" class="hidden">
            <div class="mt-6 text-gray-500">地址備註</div>
            <input name="address_region" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">
        </div>

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>推薦館舍</div>
        <select class="mt-2 w-full bg-gray-100 rounded p-1 shadow-inner " id="recommend_museum">
            <option disabled selected>選擇館舍</option>
            @foreach ($museums as $museum)
                <option value="{{$museum->name}}">{{$museum->name}}</option>
            @endforeach
            <option value="其他">其他</option>

        </select>

       <div id="recommend_museum_div" class="hidden">
            <div class="mt-6 text-gray-500">推薦單位/人員</div>
            <input name="recommend_museum" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text" placeholder="若無則填寫無">
       </div>


        <div class="mt-6">
            <input type="checkbox" name="agree_document" id="agree_document">
            <label for="agree_document">
                <span class="text-color-third">同意</span>
                <a class="text-gray-400" href="javascript:window.modelToggle()">藝點通會員條款</a>
            </label>
        </div>
        <button class="my-6 w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">送出</button>
    </form>


</div>


@stop

@section('model-content')
<div id="model-content" class="overflow-hidden bg-white w-10/12 h-3/4 rounded shadow-2xl">
    <div class="h-full flex flex-col justify-between">
        <div>
            <h1 class="font-bold text-center mt-6 ">藝點通會員條款</h1>
        </div>
        <div class="h-5/6 p-6 overflow-scroll ">
            <p>會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款會員條款會員條款會員條款會員條款會員條款
                會員條款
                會員條款會員條款會員條款會員條款
                會員條款會員條款會員條款
                會員條款會員條款
                會員條款會員條款12
                會員條款會員條款
            </p>
        </div>
        <div>
            <a href="javascript:window.modelToggle()">
                <button
                    class="w-full py-6 text-white text-color-main shadow-inner block md:inline-block font-medium">取消</button>
            </a>
        </div>
    </div>



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

<script>
    // 居住區域
    const _address_select = document.querySelector('#address_select');
    const _address_input = document.querySelector("#address_div > input");
    const _address_div = document.querySelector("#address_div");
    _address_select.addEventListener('change',()=>{
        _address_input.value = _address_select.value
        if(_address_input.value == "非臺中區域"){
            _address_div.classList.remove('hidden');
            _address_input.value =''
        }else{
            _address_div.classList.add('hidden');
        }
    })

    // 推薦單位
    const _rem_select = document.querySelector('#recommend_museum');
    const _rem_input = document.querySelector("#recommend_museum_div > input");
    const _rem_div = document.querySelector("#recommend_museum_div");
    _rem_select.addEventListener('change',()=>{
        _rem_input.value = _rem_select.value
        if(_rem_input.value == "其他"){
            _rem_div.classList.remove('hidden');
            _rem_input.value =''
        }else{
            _rem_div.classList.add('hidden');
        }
    })
</script>
@stop