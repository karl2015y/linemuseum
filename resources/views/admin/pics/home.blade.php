<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload and edit images in Laravel using Croppic jQuery plugin</title>
    <style>
        body{
            margin: 0;
            display: flex;
            justify-content: center;
        }
    </style>
    
</head>
<body>
    <link rel="stylesheet" href="/plugins/croppic/assets/css/main.css"/>
    <link rel="stylesheet" href="/plugins/croppic/assets/css/croppic.css"/>
    <div id="cropContainerEyecandy">
    </div>

<script src="/plugins/croppic/assets/js/jquery-2.1.3.min.js"></script>
<script src="/plugins/croppic/assets/js/croppic.min.js"></script>
<script>
    const path = '{{$path}}';
    const filename = '{{$filename}}';
    const domId = 'cropContainerEyecandy'
    var eyeCandy = $(`#${domId}`);
    eyeCandy.width('{{$w}}');
    eyeCandy.height('{{$h}}');
    var croppedOptions = {
        modal:true,

        onAfterImgCrop: function(){ eyeCandy.append(`<input type="hidden" name="${filename}" value="${eyeCandy.children('img').attr("src")}" />`);  },
        rotateControls:false,
        uploadUrl: '{{route("picupload")}}',
        uploadData:{path,filename},
        cropUrl: '{{route("piccrop")}}',
        cropData:{
            'width' : eyeCandy.width(),
            'height': eyeCandy.height()
        }
    };
    var cropperBox = new Croppic(domId, croppedOptions);

</script>
</body>
</html>