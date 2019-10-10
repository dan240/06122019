
@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Write a message</span>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/viewFundingType')}}">View Funding Type</a>
        </div>
        </div>
        {{ Form::open(['class'=>'submitMessage','method'=>'post'])}}
        <div class="alert alert-danger col-md-12 message-error"></div>
        <div class="company-info">
        <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <label class="form-group" for="status">Sender User</label>
                        <div class="form-group">
                            <select name="sender" id="sender">
                            <option value="">---Select Sender User---</option>
                            @foreach($data as $val)
                            <option value="{{$val['id']}}">{{$val['firstname']}} {{$val['lastname']}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <label class="form-group" for="status">Reciever User</label>
                        <div class="form-group">
                            <select name="reciever" id="reciever">
                        </select>
                    </div>
                    </div>
                </div>  
                <div class="row">  
                    <div class="col-md-12">
        <div class="form-group"> <label>Add Comments</label>
        <div class="form-group inner-label-holder textarea">
        <textarea class="form-control" name="message" placeholder="" rows="4"></textarea>
</div>
        </div>
        </div>
</div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                <label class="radio-inline">
                <input type="radio" name="optradio" checked>Meet During Conference
                </label>
            </div>
                    <div class="col-md-6">
                <label class="radio-inline">
                <input type="radio" name="optradio" checked>Conference Call
                </label>
                    </div>
                    <div class="col-md-6">
                <label class="radio-inline">
                <input type="radio" name="optradio" checked>Meet in Investors Office
                </label>
                    </div>
                    <div class="col-md-6">
                <label class="radio-inline">
                <input type="radio" name="optradio" checked>Meet in Investors Office
                </label>
                    </div>
                </div>
            </div>
        <div class="form-group">
        <button type="submit" id="save" class="btn btn-primary">Submit</button>
        </div>
        </div>
{{Form::close()}}
    </div>
<script>
    $(document).ready(function(){
        $(".message-error").hide();
               $(".submitMessage").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                  rules: {
                        sender: {required:true},
                        reciever: {required:true},
                        message: {required:true},
                        optradio: {required:true},
                    },
                    
                    messages: {
                        sender:'Sender user should not be empty!',
                        reciever: 'Reciever user should not empty',
                        message:'Message should not empty!',
                        optradio: 'Please select an option',
                    },
                submitHandler: function() {
                    $(".submitMessage").submit();
                }
           });
        $("#save").on('click',function(e){
            if($(".submitMessage").valid()){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('Admin/sendMessage')}}",
                    data:$('.submitMessage').serialize(),
                    success:function(response)
                    {
                        if(response.msg=='success')
                        {
                            $('.message-error').html('<div class="alert alert-success">Message sent successfully</div>');
                            $(".message-error").show();
                        }else{
                            $('.message-error').html('<div class="alert alert-danger">Message not sent</div>');
                            $(".message-error").show();
                        }
                    }
                });
            }
        })
        $("#sender").on('change',function(){
            var sender_id = $(this).val();
            $.ajax({
                method:"POST",
                url:"{{url('Admin/getUserList')}}",
                data:{"_token":"{{csrf_token()}}",senderid:sender_id},
                success:function(response)
                {
                    var appenddata;
                        var data = JSON.parse(response);
                            appenddata +="<option value=''>---Select Reciever User---</option>";
                         $.each(data, function (key, value) {
                             appenddata += "<option value = '" + value.id + " '>" + value.firstname+" "+value.lastname+ " </option>";                        
                         });
                        $('#reciever').html(appenddata);
                }
            });
        });
    });  
</script>
@endsection
