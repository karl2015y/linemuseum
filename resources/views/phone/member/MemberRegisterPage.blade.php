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
        <input value="{{old('email')}}" name="email" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full"
            type="email">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>密碼</div>
        <input name="password" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">
        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>確認密碼</div>
        <input name="password_confirmation" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="password">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>名稱/暱稱</div>
        <input value="{{old('name')}}" name="name" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>連絡電話</div>
        <input value="{{old('phone')}}" name="phone" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full"
            type="text">

        <div class="mt-6 text-gray-500"><span class="text-sm text-red-500">* </span>性別</div>
        <div class="pl-3 mt-2">
            <input value="male" type="radio" name="gender" id="gender_male" {{old('gender')=='male'?'checked':''}}>
            <label for="gender_male">男</label>
            &emsp;
            <input value="female" type="radio" name="gender" id="gender_female"
                {{old('gender')=='female'?'checked':''}}>
            <label for="gender_female">女</label>
        </div>

        <div class="mt-5 text-gray-500"><span class="text-sm text-red-500">* </span>出生年月</div>
        <div class="w-full flex justify-between">
            <select value="{{old('year')}}" class="mt-2 w-3/5 bg-gray-100 rounded p-1 shadow-inner " id="year"
                name="year">
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
            <select value="{{old('month')}}" class="mt-2 w-1/3 bg-gray-100 rounded p-1 shadow-inner " id="month"
                name="month">
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
            <input name="recommend_museum" class="mt-2 bg-gray-100 rounded p-1 shadow-inner w-full" type="text"
                placeholder="若無則填寫無">
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
            <p><b>會員註冊條款</b></p>
            <p>為維護您的權益，請於註冊成為藝點通（以下簡稱「本平台」）會員前，詳細閱讀「藝點通會員權益與相關規定」，當您勾選「同意」並完成資料填寫時，即表示已充分了解並同意以下各項會員權益項目。本平台有權於任何時間修改或變更條款內容，建議您隨時注意該等條款之修改或變更，前述條款於會員及本平台間具有拘束力，亦為本平台使用之前提。如您於任何條款修改或變更後仍繼續使用本平台，視為已閱讀、瞭解並同意接受該等條款之修改或變更；如您不同意修改或變更之內容，或所屬國家或地域排除本條款內容時，應立即停止使用本平台。
            </p>
            <p><br></p>
            <p>一、申辦資格</p>
            <p>申請人持智慧型手機，開啟【藝點通】並完成註冊，即刻成為會員，並享有藝點通會員的各式優惠及福利。</p>
            <p><br></p>
            <p>二、註冊</p>
            <p>1、註冊本平台會員，需以電子信箱作為帳號並設定密碼，本平台將於收到會員註冊申請後，發送電子信箱驗證碼作為登入憑證。申請人應確保帳號及密碼的機密安全，勿將帳號密碼洩露或提供予第三人知悉，以防止他人盜用。以該會員資料登錄使用會員服務之所有行為，將被視為本人之行為，相關法律責任概由該會員自行負責。
            </p>
            <p>2、本平台會員帳號或密碼如未獲授權使用，或發生其他安全問題時，應立即通知本平台；且每次使用完畢後，應確實完成帳號登出作業，如因未遵守本項規定而發生任何損害，相關法律責任概由該會原自行負責。</p>
            <p>3、本平台註冊時應填寫之欄位應為本人提供且正確及最新的資料，不得利用偽造或變造資料作為重複註冊登錄等事項，並同時隨時更新個人資料正確性，以能獲得本平台最佳服務。</p>
            <p>4、為維護會員個人權益，若系統發生點數登錄異常時，本平台將暫停該會員點數登錄及兌換功能，於異常狀況排除後，本平台隨即恢復會員點數登錄、兌換功能或調整該會員之點數，所有資料以本平台系統紀錄為準。</p>
            <p><br></p>
            <p>三、申辦</p>
            <p>1、本平台保有會員申請或終止會員與否之權利。</p>
            <p>2、申辦人限為個人（含非本國人）申請，不適用於公司行號、團體或組織等非個人對象。</p>
            <p>3、為維護申請人權益，本平台於必要時，得於提供相關服務前驗證身份。註冊時個人資料請確實填寫完整及正確，以確保享有會員之相關權益；若因資料不完整或不實致影響自身相關會員權益，申請人應自行承擔一切責任。</p>
            <p><br></p>
            <p>四、會員權益</p>
            <p>1、集點方式：</p>
            <p>本平台為消費點與知識點，消費金額每新台幣1元，累積消費點數1點；知識點獲得點數標準依本平台公告為主。</p>
            <p>2、點數兌換：可兌換商品依據兌換兌換券商店上點數資訊給予兌換。<s></s></p>
            <p>3、集點限制：</p>
            <p>(1)會員需於結帳前出示藝點通會員以便享有優惠及累積會員點數之福利。會員點數的抵扣方式應以本平台之內部作業規定為準。</p>
            <p>(4) 點數無法移轉或兌換現金，亦不接受多個會員點數合併使用。</p>
            <p>(5) 使用點數進行兌換商品時，請所有人先確認點數餘額、折抵金額、兌換商品等無誤後再離開櫃檯。</p>
            <p>4、點數兌換品項以本平台公告為主，僅限折抵消費金額或兌換、換購禮品，均不得兌換現金。</p>
            <p>5、會員不得以不當或取巧之方式累計會員點數，本平台對此保有審核及決定是否贈點之權利。如經查證會員確有前揭不當或取巧之行為累計會員點數，本平台得視其情節，暫時停止或永久終止該會員之權利，並將依法請求損害賠償並提出刑事告訴。
            </p>
            <p><br></p>
            <p>五、注意事項</p>
            <p>1、相關優惠與權益辦法及未盡事宜均依本平台官網或館舍現場公告為準，本平台保有更改活動辦法或終止會員之權利。</p>
            <p>2、暫停或中斷會員服務：</p>
            <p>本平台於下列情形之一時，得暫停或中斷會員服務之全部或一部，對於會員不負擔任何賠償責任：</p>
            <p>(1) 對於會員服務相關系統設備進行遷移、更換或維護時。</p>
            <p>(2) 因不可歸責於本平台會員服務平台所造成服務停止或中斷。</p>
            <p>(3) 因不可抗力事由所造成會員服務停止或中斷。</p>
            <p>(4) 非本平台所得控制之事由致會員服務資訊顯示不正確、或遭偽造、偽累點、竄改、刪除或擷取、或致系統中斷或不能正常運作時。</p>
            <p>(5)如因本平台對於會員服務平台之相關系統設備進行遷移、更換或維護而必須暫停或中斷全部或一部之服務時，本平台將在相關網站上公告暫停或中斷訊息。
                對於本平台會員服務暫停或中斷可能造成之不便、資料遺失或其他經濟及時間損失，本平台對此不負任何責任。</p>
            <p>3、服務條款之增訂、修改、刪除：</p>
            <p>您同意本平台得就會員服務訂定一般措施及限制，且本平台保留隨時增訂、修改或刪除會員服務內容、會員服務條款或其他相關規定全部或一部之權利。您同意自該增訂、修改或刪除之內容經公告於本平台會員服務平台之時起，即受其拘束，本平台將不對會員個別通知，您不得對本平台主張任何權利。
                前述增訂、修改或刪除，如您於公告後繼續使用本平台各項會員服務，則視為您已經同意該增訂、修改或刪除。</p>
            <p>　</p>
            <p>六、服務停止或中斷</p>
            <p>1、本平台得於下列情形暫停或中斷會員服務之全部或部分功能，且對於使用者任何直接或間接之損害，均不負任何責任：</p>
            <p>(1) 會員服務相關軟硬體設備或電子通信設備進行搬遷、更換、升級、保養或維修時。</p>
            <p>(2) 會員有任何違反政府法令或會員權益情形。</p>
            <p>(3) 本平台因天災或其他不可抗力因素致無法提供時。</p>
            <p>(4) 其他不可歸責於本平台之事由。</p>
            <p>(5) 發生突發性之系統或設備故障。</p>
            <p>(6) 本平台所連結之相關通信或通訊服務，因任何原因而發生中斷、停止，導致服務無法提供。</p>
            <p>2、除上述情形外，本平台不保證本平台運作時絕不發生中斷、延遲或錯誤等情形，連帶影響本平台之使用品質，並可能導致通訊中斷或延遲。因此，使用者瞭解並同意於使用本平台時，應自行採取防護措施。</p>
            <p>3、使用者若因本平台停止或中斷無法使用本平台，衍生任何直接或間接之損害時，本平台不負任何賠償責任。</p>
            <p><br></p>
            <p>七、免責聲明</p>
            <p>1、本平台對本平台服務不提供任何明示或默示之擔保，包括但不限於以下事項：</p>
            <p>(1) 本平台不受干擾、即時更新、安全可靠或免於出錯。</p>
            <p>(2) 本平台使用而取得之結果為正確或可靠。</p>
            <p>(3) 經由本平台而取得之任何產品、服務、資訊或其他資料將符合使用者的需求或期望。</p>
            <p>2、關於本平台服務之使用下載或取得任何資料應由使用者自行考量且自負風險，因前述任何資料之下載而導致系統之任何損失或資料流失，應自負完全責任。</p>
            <p>3、本平台所提供之各項功能，均依該功能當時之現況提供使用，本平台對於其效能、速度、完整性、可靠性、安全性、正確性等，皆不負擔任何明示或默示之擔保責任。</p>
            <p>4、本平台並不保證本平台之網頁、伺服器、網域等所傳送的電子郵件或其內容不會含有電腦病毒等有害物；亦不保證郵件、檔案或資料之傳輸儲存均正確無誤不會斷線和出錯等，因各該郵件、檔案或資料傳送或儲存失敗、遺失或錯誤等所致之損害，本平台不負賠償責任。
            </p>
            <p><br></p>
            <p>八、隱私權</p>
            <p>1、本平台將保留使用者在本平台瀏覽或查詢時伺服器自行產生的相關記錄，包括使用連線設備的 IP 位址、使用時間、使用的瀏覽器、瀏覽及點選資料紀錄等。</p>
            <p>2、本平台及本平台官網均可能基於行銷目的使用
                Cookies（Cookies係伺服端為了區別使用者的不同，經由瀏覽器寫入使用者硬碟的一些簡短資訊。只有原設置Cookies的網站能讀取其內容。），例如儲存偏好的特定種類資料、儲存相關密碼等，以方便使用者於使用本平台時不需重複輸入密碼。Cookies
                並不含任何資料使得他人透過電話、電子郵件或其他方式與您聯絡。使用者可在網站瀏覽器上設定功能以獲知何時 Cookies被記錄或避免 Cookies的設置。</p>
            <p><br></p>
            <p>九、智慧財產權</p>
            <p>本平台所提供之任何資訊，包括但不限於文字、軟體、音樂、聲音、影像、圖片、動態影像或其他相關資料、素材等，均受本平台及其供應商之著作權、商標權、專利權等智慧財產權及相關法律保護，未經本平台同意或授權，使用者不得擅自為重製、改作、公開傳輸、散佈等利用行為，如因違反本條規定而發生侵害權利之情事時，使用者應自行負擔完全法律責任，本平台並保留一切法律追訴權。
            </p>
            <p><br></p>
            <p>十、 使用者義務與責任</p>
            <p>1、本平台僅供使用者個人正常合法使用，不得轉售或以任何方式轉讓予他人使用。</p>
            <p>2、除經本平台事前書面同意，使用者不得對本平台之內容、商標及本平台之全部或一部功能擅自進行出售、交易、轉售、轉授權、重製、傳輸、散佈、修改、改作、連結、進行還原工程、解編、反向組譯、製作衍生著作或以其他任何形式、基於任何目的加以使用、出版或發行之行為。使用者如違反前述責任與義務，導致本平台或任何第三人之損害者，應負擔賠償責任。
            </p>
            <p>3、使用者同意不得進行下列行為：</p>
            <p>(1) 違反法律、法規、行政命令或主管機關之要求。</p>
            <p>(2) 從事危害公共秩序或風俗的行為。</p>
            <p>(3) 以任何方式干擾或破壞本平台平台及系統。</p>
            <p>(4) 用於不法交易行為或有任何不當、不合常理之使用行為。</p>
            <p>(5) 違反本平台條款之規定。</p>
            <p>(6)侵犯本平台或第三人的智慧財產權、隱私權、名譽等。</p>
            <p>(7) 違反依法律或是契約所應負之保密義務。</p>
            <p>(8) 傳輸或是散佈電腦病毒。</p>
            <p>(9) 從事未經公司授權之不當行為。</p>
            <p>4、使用者因下列行為導致其權益受損，需自行負擔相關法律責任及損失：</p>
            <p>(1) 使用者未妥善保管會員帳號或交易密碼。</p>
            <p>(2) 使用者出於故意或過失，而使他人知悉其會員帳號或交易密碼。</p>
            <p>(3) 使用者之智慧型行動終端裝置，因使用者自行改機、解碼、越獄或其他類似情形，致破壞或變更原裝置或本平台之安全機制及功能。</p>
            <p>(4) 本平台保有修改本活動辦法之權利，如有任何異動，其餘未盡說明之處均依本平台官網公告說明為準。</p>
            <p><br></p>
            <p>十一、個資保密宣言</p>
            <p>申請人同意藝點通蒐集個人消費及相關訊息，藝點通依據個人資料保護法第八條規定，蒐集、處理及使用告知下列事項：</p>
            <p>1、個人資料蒐集目的：行銷、法人對會員所有人名冊之內部管理、調查、統計與研究分析、非公務機關依法定義務所進行個人資料之蒐集處理及利用、契約、類似契約或其他法律關係事務、消費者、客戶管理與服務、稅務行政、網路購物及其他電子商務服務。
            </p>
            <p>2、申請人得自由選擇是否提供相關個人資料，惟若拒絕提供相關個人資料，本平台將無法進行必要之審核及處理作業，致無法提供完善服務。</p>
            <p>3、申請人同意並允許藝點通及其任何聯營方得於前述蒐集目的範圍內，蒐集、處理及利用申請人個人資料；並得提供申請人全部或部分個人資料予合作廠商，以便提供各項優惠權益及獲得各種促銷活動訊息。</p>
            <p>4、除法律另有規定外，申請人得隨時向本平台請求停止蒐集、處理、利用或刪除其個人資料，惟行使前開權利將影響會員權益，若申請人請求刪除個資，視同同意其會員資格及相關權益自刪除時起失效。會員所有人退會或要求刪除個人資料時，將無法享有會員所有人之福利。
            </p>
            <p>5、申請人就本平台保有之自身個人資料，亦得以向本平台要求行使以上權利，惟本平台依法得酌收必要成本費用。</p>
            <p><br></p>
            <p>十二、準據法與管轄法院</p>
            <p>本服務條款以中華民國法令為準據法。使用者與本平台間因本服務、或本服務條款所生之爭議，如因此而涉訟，除法令另有強制規定者應依其規定者外，以臺灣臺中地方法院為第一審管轄法院。</p>
            <p><br></p>
            <p>十三、其他事項</p>
            <p>臺中市博物館與地方文化館共同品牌 </p>
            <p>藝點通</p>
            <p>客服專線：04-22289111#25119 </p>
            <p>客服信箱：tccgc22289111@gmail.com</p>
            <p>通訊地址：臺中市政府文化局 臺中市西屯區臺灣大道三段99號8F</p>
            <p>服務時間：週一至週五08：00 ~ 17：00</p>
        </div>

        <div>
            <a href="javascript:window.modelToggle()">
                <button
                    class="w-full py-6 text-white text-color-main shadow-inner block md:inline-block font-medium">關 閉</button>
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