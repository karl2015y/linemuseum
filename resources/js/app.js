require('./bootstrap');

// 富文本
import E from "wangeditor";
import i18next from "i18next";
const createEdit = (textarea_css_feature)=>{
  let div_css_feature = "div_description"
  const $text1 = document.querySelector(textarea_css_feature)
  const _div = document.createElement("DIV"); 
  _div.id=div_css_feature;
  div_css_feature = '#'+div_css_feature;
  $text1.parentNode.insertBefore(_div,  $text1)
  const editor = new E(div_css_feature)
  // 選擇語言
  editor.config.lang = 'zh-TW'
  // 自定義語言
  editor.config.languages['zh-TW'] = {
      wangEditor: {
              重置: '重置',
              插入: '插入',
              默认: '初始化',
              创建: '建立',
              修改: '修改',
              如: '如',
              请输入正文: '請輸入文字',
              menus: {
                  title: {
                      标题: '標題',
                      加粗: '加粗',
                      字号: '字體大小',
                      字体: '字體',
                      斜体: '斜體',
                      下划线: '底線',
                      删除线: '刪除',
                      缩进: '縮排',
                      行高: '行高',
                      文字颜色: '文字顏色',
                      背景色: '背景色',
                      链接: '連結',
                      序列: '序列',
                      对齐: '對齊',
                      引用: '引用',
                      表情: '表情',
                      图片: '圖片',
                      视频: '影片',
                      表格: '表格',
                      代码: 'Code',
                      分割线: '分割線',
                      恢复: '下一步',
                      撤销: '上一步',
                      全屏: '全螢幕',
                      取消全屏: '取消全螢幕',
                      待办事项: '代辦事項',
                  },
                  dropListMenu: {
                      设置标题: '設定標題',
                      背景颜色: '背景顔色',
                      文字颜色: '文字顔色',
                      设置字号: '設定字體大小',
                      设置字体: '設定字體',
                      设置缩进: '設定縮排',
                      对齐方式: '對齊方式',
                      设置行高: '設定行高',
                      序列: '序列',
                      head: {
                          正文: '正文',
                      },
                      indent: {
                          增加缩进: '增加縮排',
                          减少缩进: '減少縮排',
                      },
                      justify: {
                          靠左: '靠左',
                          居中: '居中',
                          靠右: '靠右',
                          两端: '兩端',
                      },
                      list: {
                          无序列表: '無序列錶',
                          有序列表: '有序列錶',
                      },
                  },
                  panelMenus: {
                      emoticon: {
                          默认: '預設',
                          新浪: 'sina',
                          emoji: 'emoji',
                          手势: '小手手',
                      },
                      image: {
                          上传图片: '上傳圖片',
                          网络图片: '線上圖片',
                          图片地址: '圖片網址',
                          图片文字说明: '圖片文字說明',
                          跳转链接: '跳轉鏈接',
                      },
                      link: {
                          链接: '連結',
                          链接文字: '連結文字',
                          取消链接: '取消連結',
                          查看链接: '查看連結',
                      },
                      video: {
                          插入视频: '插入影片',
                          上传视频: '上傳影片',
                      },
                      table: {
                          行: '行',
                          列: '列',
                          的: '的',
                          表格: '表格',
                          添加行: '新增行',
                          删除行: '刪除行',
                          添加列: '新增列',
                          删除列: '刪除列',
                          设置表头: '設定表頭',
                          取消表头: '取消表頭',
                          插入表格: '插入表格',
                          删除表格: '刪除表格',
                      },
                      code: {
                          删除代码: '刪除Code',
                          修改代码: '修改Code',
                          插入代码: '插入Code',
                      },
                  },
              },
              validate: {
                  张图片: '張圖片',
                  大于: '大於',
                  图片链接: '圖片連結',
                  不是图片: '不是圖片',
                  返回结果: '返回結果',
                  上传图片超时: '上傳圖片超時',
                  上传图片错误: '上傳圖片錯誤',
                  上传图片失败: '上傳圖片失敗',
                  插入图片错误: '插入圖片錯誤',
                  一次最多上传: '一次最多上傳',
                  下载链接失败: '下載鏈接失敗',
                  图片验证未通过: '圖片驗證未通過',
                  服务器返回状态: '伺服器返回狀態',
                  上传图片返回结果错误: '上傳圖片返回結果錯誤',
                  请替换为支持的图片类型: '請更換成支援的圖片類型',
                  您插入的网络图片无法识别: '您上傳的線上圖片無法識別',
                  您刚才插入的图片链接未通过编辑器校验: '您剛才插入的圖片連結未通過編輯器驗證',
                  插入视频错误: '插入影片錯誤',
                  视频链接: '影片連結',
                  不是视频: '不是影片',
                  视频验证未通过: '影片驗證未通過',
                  个视频: '個影片',
                  上传视频超时: '上傳影片超時',
                  上传视频错误: '上傳影片錯誤',
                  上传视频失败: '上傳影片失敗',
                  上传视频返回结果错误: '上傳影片返回結果錯誤',
              },
          },
  }
  // 引入 i18next 插件
  editor.i18next = i18next
  editor.config.onchange = (html) => {
      // 第二步同步更新到 textarea
      $text1.value = html
  }

  // 配置選單列，設定不需要的菜單
      editor.config.excludeMenus = [
      'image',
      'video'
  ]
  // 配置全螢幕功能按鈕是否顯示
  editor.config.showFullScreen = false;

  editor.create()
  // 第一步，初始化 textarea 的值
  editor.txt.html($text1.value);

}
window.createEdit = createEdit;

// 提醒
const createNotification = (type, title, text, index=0)=>{
  var template = document.createElement('template');
  const icon_colors = {
      'success':'text-green-500',
      'error':'text-red-500',
      'warning':'text-yellow-500',
  }
  const icons = {
      'success':'<svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
      'error':'<svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
      'warning':'<svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
  }
  const in_animation = 'animate__bounceInRight';
  const out_animation = 'animate__backOutRight';
  template.innerHTML = `<div style="top:calc(${document.body.offsetWidth>=623?index*65:index*120}px + 1rem); z-index:60000" class="animate__animated ${in_animation} bg-white fixed flex flex-col pl-6 pr-8 py-5 right-2 rounded-lg shadow sm:flex-row sm:items-center sm:pr-6">
                              <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                                  <div class="${icon_colors[type]}">
                                      ${icons[type]}
                                  </div>
                                  <div class="text-sm font-medium ml-3">${title}</div>
                              </div>
                              <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">${text}</div>
                          </div>`
      const ele = document.body.appendChild(template.content.firstElementChild);
      setTimeout(() => {
          ele.classList.remove(in_animation)
      }, 1000);
      setTimeout(() => {
          ele.classList.add(out_animation)
      }, 3000+index*100);
      setTimeout(() => {
          ele.remove()
      }, 5000+index*100);
  
}
window.createNotification = createNotification;


// 側邊欄在手機時的開關
const sidebar = document.querySelector(".sidebar");

document.querySelectorAll(".mobile-menu-button").forEach((e=>{
  e.addEventListener("click", () => {
    sidebar.classList.toggle("-translate-x-full");
  });
}))


// 所有輸入框的動畫
const inputInit = (input)=>{
  const val = input.value
  if(!val) {
      input.parentElement.classList.add('form-input-is-empty')
  } else {
      input.parentElement.classList.remove('form-input-is-empty')
  }
}
const allInputs = document.querySelectorAll('.formInputGroup input');
for(const input of allInputs) {
  inputInit(input)
  input.addEventListener('input', () => {
    inputInit(input)  
  })
}

// 抓URL的Query
const getUrlParameter=(name) => {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
window.getUrlParameter = getUrlParameter;


// modal 
const buttonBindModal = (buttonId, csrf, type, title, content, route)=>{
    const createModal = (csrf, type, title, content, route)=>{
        var template = document.createElement('template');
        const methods = {
            'confirm':"",
            'delete':'<input type="hidden" name="_method" value="DElete"/>',
            'disable':'<input type="hidden" name="_method" value="PUT"/>',
        }
        const icon_colors = {
            'confirm':'green',
            'delete':'red',
            'disable':'yellow',
        }
        const icons = {
            'confirm':'<svg class="w-16 h-16 flex items-center mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
            'delete':'<svg class="w-16 h-16 flex items-center mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>',
            'disable':'<svg class="w-16 h-16 flex items-center mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>'
        }
        template.innerHTML = `<div id="modal-id" style="z-index: 60000"
            class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        <span class="text-${icon_colors[type]}-500">
                            ${icons[type]}
                        </span>
                        <h2 class="text-xl font-bold py-4 ">${title}</h3>
                            <p class="text-sm text-gray-500 px-8">${content}</p>
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button id="modal-close"
                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                            取消
                        </button>
                        <form class="inline-block" action="${route}" method="post">
                            ${csrf}
                            ${methods[type]}
                            <button
                                class="mb-2 md:mb-0 bg-${icon_colors[type]}-500 border border-${icon_colors[type]}-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-${icon_colors[type]}-600">
                                確定
                            </button> 
                        </form>
                
                    </div>
                </div>
            </div>
        </div>`
        const ele = document.body.appendChild(template.content.firstElementChild);
        ele.querySelector('#modal-close').addEventListener('click',()=>{
            document.querySelector("#modal-id").remove()
        })
        
    }
    if(document.querySelector(`#${buttonId}`)){
        document.querySelector(`#${buttonId}`).addEventListener('click',()=>{
            createModal(csrf, type, title, content, route)
        })
    }
}
window.buttonBindModal = buttonBindModal;