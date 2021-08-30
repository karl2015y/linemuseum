<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException; 

use Intervention\Image\Facades\Image;

class CropController extends Controller
{
    //
    public function home(Request $request){
        $datas = $request->all();
        return view('admin.pics.home', $datas);
    }

    public function postUpload( Request $request){
        try {
            $request->validate([
                'path' => 'required',
                'filename' => 'required',
                'img' => 'required|mimes:png,gif,jpeg,jpg,bmp',
            ],[
                'img.mimes' => '上傳的檔案必須為圖片檔',
                'img.required' => ':attribute為必填',
                'path.required' => ':attribute為必填',
                'filename.required' => ':attribute為必填',
            ],[
                'img'=>'圖片',
                'path'=>'圖片位置',
                'filename'=>'圖片名稱',
            ]);
        }catch (ValidationException $exception) {
                // 取得 laravel Validator 實例
                $validatorInstance = $exception->validator;
                // 取得錯誤資料
                $errorMessageData = $validatorInstance->getMessageBag();
                // 取得驗證錯誤訊息
                $errorMessages = $errorMessageData->getMessages();

            return response()->json([
                'status' => 'error',
                'message' => $errorMessages['img'][0],
            ], 200);
        }


        $photo = $request->file('img');
        // 存檔
        $imagePath = $photo->storeAs($request->input('path'), $request->input('filename').'.jpg', 'public');
        // 壓縮
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(900, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(public_path("storage/{$imagePath}"), 60);
        // 回傳
        return response()->json([
            'status'    => 'success',
            'url'       => "/storage/{$imagePath}?t=". rand(),
            'width'     => $image->width(),
            'height'    => $image->height()
        ], 200);
    }

    public function postCrop(Request $request){
        $form_data = $request->all();
        if(strpos($form_data['imgUrl'],'?t=')){
            $form_data['imgUrl'] = explode('?t=', $form_data['imgUrl'])[0];
        }
        $image_path = public_path($form_data['imgUrl']);
        $image_url = $form_data['imgUrl'];

        // resized sizes
        $imgW = $form_data['imgW'];
        $imgH = $form_data['imgH'];
        // offsets
        $imgY1 = $form_data['imgY1'];
        $imgX1 = $form_data['imgX1'];
        // crop box
        $cropW = $form_data['width'];
        $cropH = $form_data['height'];
        // rotation angle
        $angle = $form_data['rotation'];

        // 找到圖片，並剪裁
        $image = Image::make( $image_path );
        $image->resize($imgW, $imgH)
            ->rotate(-$angle)
            ->crop($cropW, $cropH, $imgX1, $imgY1);
        // 好了就存檔
        $image->save($image_path);

        if( !$image) {
            return response()->json([
                'status' => 'error',
                'message' => '伺服器錯誤，請重新上傳',
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'url' => $image_url.'?t='. rand()
        ], 200);

    }
}
