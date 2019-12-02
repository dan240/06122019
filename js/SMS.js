/*var mousedownHappened = false;
var validCount = 0;
var invalidCount = 0;
var validNumbers = [];
var tableData = [];
var mmsSize = 0;
var msgSize = 0;
var totalSize = 0;
var fileSize = 0;
var basic;
var fileName;
var actualSize = 0;
var textSize = 0.00;
var contentType;


$(function () {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
           var reader = new FileReader();
           
           reader.onload = function (e) {
               $uploadCrop.croppie('bind', {
                   url: e.target.result
               });
           }
           
           reader.readAsDataURL(input.files[0]);
       }
       else {
           swal("Sorry - you're browser doesn't support the FileReader API");
       }
   }

   $uploadCrop = $('#imgContainer').croppie({
        viewport: {
            width: 200,
            height: 200,
        },
        showZoomer: false,
        enableOrientation: false,
        enableResize: true,
    });

    $imageTargetCropper = $('#imgContainer');
    $imageTargetCropper.data('cropper', null);

    $("input[name='photo']").on('change', function () {
        $('#modalImgEditor').modal('show');

        $imageTargetCropper.data('cropper', this);
        
    });

    $('#modalImgEditor').on('shown.bs.modal', function (e) {
        readFile($imageTargetCropper.data('cropper'));
    });

    $('#SelectImage').on('click', function (ev) {
        $('#upload-photo').val('');
        $('#displayimage').attr('src', '');

        $uploadCrop.croppie('result', {
            type: 'blob',
            size: 'viewport'
        }).then(function (blob) {
            popupResult(blob);
        });
    });

});

function popupResult(blob) {
    var reader = new FileReader();
    reader.readAsDataURL(blob);

    reader.onloadend = function () {
        base64data = reader.result;
        $('#displayimage').attr('src', base64data);
        $('#FilePayload').val(base64data.split(',')[1]);
        $('#modalImgEditor').modal('hide');
    }
}

var editimage = function (img) {
    if (fileName != null) {
        var image = $("#mms_media").attr('src');
        $('#modalImgEditor').modal('show');

        setTimeout(function () {
            showImageDialog(image);
        }, 1000);
    } else {
        console.log("no file data found")
    }
};

var showfile = function (input) {
    $('.imageError').html("");

    if (input.files && input.files[0]) {
        var file = input.files[0];
        fileName = file.name;
        fileSize = file.size;
        contentType = file.type;
        var mmsSize = file.size / 1024 * 1.34;
        var filerdr = new FileReader();

        filerdr.onload = function (e) {
            if (contentType.split('/')[0] === 'image') {
                $('#mms_media').attr('src', e.target.result);
                $('#mms_media').show();
            }
            if (contentType.split('/')[0] === 'audio' || contentType.split('/')[0] === 'video') {
                $('#mms_media').hide();
            }

            $('#FilePayload').val(e.target.result.split(',')[1]);
        };
        filerdr.readAsDataURL(file);
    }
};

var showImageDialog = function (imageData) {
    $uploadCrop.bind({
        url: imageData,
    });
}
*/

window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('displayimage');
    var image = document.getElementById('cropper-img');
    var input = document.getElementById('FilePayload');
    var file_el = document.getElementById('upload-photo');
    var $modal = $('#modalImgEditor');
    var cropper;

    file_el.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          
          $modal.modal('show');
        };
        
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
        });
        console.log(cropper);
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $('#SelectImage').on('click', function () {
        var canvas;
        var base64data;

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });
            
            base64data = canvas.toDataURL();
            avatar.src = base64data;
            input.value = base64data.split(',')[1];

            $modal.modal('hide');
        }
    });
});
