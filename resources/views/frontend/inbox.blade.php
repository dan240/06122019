@extends('layouts.investor')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.min.css" />
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
   <section class="inner-pages">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <h2 class="title">LondCap <span>Mail</span></h2>
                    <div class="sidebar-menu">
                        <ul>
                            <li class="active"><a href="javascript:;" id="inbox-div">Inbox</a></li>
                            <li><a href="javascript:;" id="outbox-div">Outbox</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                    <div class="messages-content">
                        <div class="messages-header clearfix">
                            <ul class="actions">
                                <li class="compose"><a href="#" class="btn btn-compose">+ Compose New</a></li>
                                <li class="delete"><a id="delete" href="#">Delete</a></li>
                                <li class="mark-unread"><a href="#">Mark Unread</a></li>
                            </ul>
                        </div><!-- .messages-header -->
                     <div  id="inbox">
                        <?php if(!empty($inbox)){?>
                        <form method="post" id="message_from">
                            <table cellspacing="0" cellpadding="0" border="0" class="messages">
                                <tbody>
                                        @foreach($inbox as $data)
                                        <tr>
                                        <td class="avatar">
                                        <?php $img = 'images/user.png';
                                            if(!empty($data['inbox_img_comp']) && !empty($data['inbox_img_comp']['image_name'])){
                                                $img = 'uploads/images/'.$data['inbox_img_comp']['image_name'];
                                            }
                                            else if(!empty($data['inbox_img_inv']) && !empty($data['inbox_img_inv']['image_name'])){
                                                $img = 'uploads/images/'.$data['inbox_img_inv']['image_name'];
                                            }
                                            ?>
                                          <img class="view-message" rel="177391" src="{{ asset($img)}}" alt="User">
                                        </td>
                                        <td class="envelope view-message" rel="177391">
                                            <a href="#" class="view-message" onclick="viewrecieveMsg('{{ @$data['sender_id']}}')" rel="177391">
                                                <span class="sender">{{ $data['inboxuser']['firstname'] }} {{ $data['inboxuser']['lastname'] }} </span>
                                                <br>
                                                {{ @$data['messages']}}      
                                            </a>
                                        </td>
                                        <td class="meta">
                                            <span class="timestamp">
                                               {{ @$data['created_at']}}
                                            </span>
                                            <a href="#" class="delete-message" rel="177391">
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                        <td class="select">  

                                            <input type="checkbox" id="{{ $data['id'] }}" name="id[]">
                                        </td>
                                        </tr>
                                        @endforeach
                                    
                                </tbody>
                            </table>
                    
                    <input type="hidden" name="message_id" id="message_id" value="">
                    <input type="hidden" value="">
                </form>
                <?php } else { ?>
                    <div class="user-messaging-empty" >
                        <p>You have no messages</p>
                    </div>
                <?php } ?>
    
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end pull-right">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> -->
                        </div>
                    </div>
                    <div class="outbox_div" id="outbox" style="display:none;">
                        <?php if(!empty($outbox)) { ?>
                        <form method="post" id="message_to">
                            <table cellspacing="0" cellpadding="0" border="0" class="messages">
                                <tbody>
                                @foreach($outbox as $data)                            
                                <tr>
                                    <td class="avatar">
                                    <?php $img = 'images/user.png';
                                            if(!empty($data['outbox_img_comp']) && !empty($data['outbox_img_comp']['image_name'])){
                                                $img = 'uploads/images/'.$data['outbox_img_comp']['image_name'];
                                            }
                                            else if(!empty($data['outbox_img_inv']) && !empty($data['outbox_img_inv']['image_name'])){
                                                $img = 'uploads/images/'.$data['outbox_img_inv']['image_name'];
                                            }
                                            ?>
                                        
                                      <img class="view-message" rel="177391" src="{{ asset($img)}}" alt="User">
                                    </td>
                                    <td class="envelope view-message" rel="177391">
                                        <a href="#" class="view-message" onclick="viewSendMsg('{{ @$data['reciever_id']}}')" rel="177391">
                                            <span class="sender">{{ $data['outboxuser']['firstname'] }} {{ $data['outboxuser']['lastname'] }}</span><br>
                                            {{ @$data['messages']}}       
                                        </a>
                                    </td>
                                    <td class="meta">
                                        <span class="timestamp">
                                           {{ @$data['created_at']}}
                                        </span>
                                        <a href="#" class="delete-message" onclick="viewsendMsg('{{ @$data['id']}}')" rel="177391">
                                            <span>Delete</span>
                                        </a>
                                    </td>
                                    <td class="select">                      
                                         <input type="checkbox" id="{{ $data['id'] }}" name="id[]">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                <!-- <input type="hidden" name="message_id" id="message_id" value=""> -->
                <input type="hidden" value="">
            </form>
            <?php } else { ?>
                <div class="user-messaging-empty" >
                    <p>You have no messages</p>
                </div>
            <?php } ?>
         </div>
    </div>
   
    </div>
</div>
</div>
    
</section>
    
    <div class="new-message" style="display: none;">
        <div class="user-message-header">
            <h2>New Message</h2>
            <a href="#" class="message-close">x</a>
        </div><!-- .user-message-header -->
        <div class="user-message-content">
            {{Form::open(['class'=>'form','method'=>'post'])}}
                    <div class="checkbox">
                        <label><input type="checkbox" name="interested" value="1"  > Message Followers</label>
                    </div>
                    <div class="form-group">
                        <input type="name" name="to" id="namesearch" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="sub" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="6" placeholder="Message:" name="msg"></textarea>
                    </div>
                    <button type="submit" id="send" class="btn btn-primary">Send Message</button>
            {{ Form::close()}}
        </div><!-- user-message-content -->
    </div>


 <script>
       $("#outbox-div").click(function() {
           $("#outbox").css("display","block");
            $("#inbox-div").parents('ul').find('li').removeClass('active');
             $("#outbox-div").parents('li').addClass('active');
       });
         $("#outbox-div").click(function() {
           $("#inbox").css("display","none")
       }); 
            $("#inbox-div").click(function() {
           $("#inbox").css("display","block")
           $("#outbox-div").parents('li').removeClass('active');
           $("#inbox-div").parents('li').addClass('active');
       });
         $("#inbox-div").click(function() {
           $("#outbox").css("display","none")
       });
    </script>
<script>
    function viewrecieveMsg(id){
        window.location.href="{{ url('User/viewRecieveMsg/') }}/"+id;
    }

    function viewSendMsg(id){
        window.location.href="{{ url('User/viewSendMsg/') }}/"+id;
    }
</script>
<script>
       $(document).ready(function(){
            $(".btn-compose").click(function () {
                $(".new-message").css("display","block")
            });

            $(".message-close").click(function () {
                $(".new-message").css("display","none")
            });
                

                /*Code to cheked checkboxes to delete data from table*/
            
            $("#checkall").click(function(){
                if(this.checked)
                {
                    $(".checkbox").each(function(){
                        this.checked=true;
                    });
                }else{
                    $(".checkbox").each(function(){
                        this.checked=false;
                    });                
                }
            });

            /* close Code to cheked checkboxes data from table*/
            
            /*Code to get cheked checkboxes from table*/
            $("#delete").on('click', function(){
                var dataArr = new Array();
                if($("input:checkbox:checked").length>0)
                {
                    $("input:checkbox:checked").each(function(){
                        dataArr.push($(this).attr("id"));
                        $(this).closest('tr').remove();
                    });
                    //console.log(dataArr);
                    sendResponse(dataArr)

                }else{
                    alert("No Record Selected");
                }
            }); 
        /*close Code to cheked checkboxes from table*/



        $("#send").on('click',function(e){
            e.preventDefault();
            $.ajax({
                url:"{{url('User/sendUserMessage')}}",
                method:"POST",
                data:$('.form').serialize(),
                success:function(response){
                    alert('Message sent succefully');
                }

            });

        });
        BindControls();
    });

    /*Code to cheked checkboxes delete data from table*/
    function sendResponse(dataArr)
    {
        $.ajax({
            url:"{{ url('User/deleteMsgs')}}",
            type:"POST",
            data:{"_token":"{{csrf_token()}}",id:dataArr},
            success:function(data)
            {
                //debugger;
                console.log(data);
                //dataTable.ajax.reload();
                //$('#student_table').DataTable().ajax.reload();
                //$('#example').DataTable().clear();
                //$('#example').DataTable().draw('full-reset');
            },
            error:function(error){
                alert(error);
            }
        });
    }

     function BindControls(){
        $.ajax({
            method:"POST",
            url:"{{url('User/findNamelist')}}",
            data:{"_token":"{{csrf_token()}}"},
            success:function(response)
            {
                z
                var nameList = [];
                var names = JSON.parse(response);
                $.each(names,function(key,value){
                    nameList.push(value['id']+':'+value['firstname']+' '+value['lastname']);
                })
                $("#namesearch").on( "keydown", function( event ) {}).autocomplete({
                    source: nameList,
                    minLength: 0,
                    scroll: true,
                    html:true,
                    select : function(event, ui){
                        var terms = split( this.value );
                        
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push( ui.item.value );
                        // add placeholder to get the comma-and-space at the end
                        terms.push( "" );
                        this.value = terms.join( "" );
                        return false;
                    }
                    })/*.focus(function() {
                        $(this).autocomplete("search", "");
                    })*/;
            }
        });
    }
    function split( val ) {
      return val.split( /,\s*/ );
    }

    </script>

    @endsection
