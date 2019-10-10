var mousedownHappened = false;
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
    
   
   

var el = document.getElementById('imgContainer');
basic = new Croppie(el, {
    
    showZoomer: true,
    enableResize: true,
    enableOrientation: false,
    mouseWheelZoom: 'ctrl',
    
});
$imageTargetCropper =  $('#imgContainer');
$imageTargetCropper.data('cropper',null);


    

     $("input[name='photo']").on('change', function () {

        $('#modalImgEditor').modal('show');
        
        var file = this.files[0];
        var filerdr = new FileReader();
        filerdr.onload = function (e) {
            basic.bind({
                url: e.target.result,
            });
        };
        filerdr.readAsDataURL(file);

    });


    $('#SelectImage').on('click', function (ev) {
        $('#upload-photo').val('');
        $('#displayimage').attr('src', '');
        basic.result({
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
    }
    else {
        console.log("no file data found")
    }
};



var showfile = function (input) {
    console.log("showFile Function Triggered");
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
    basic.bind({
        url: imageData,
    });
}





