   @extends('layouts.home')
@section('content')
<?php $requestMaster = array('1'=>'Meet During Conference', '3'=>'Meet in Investors Office', '2'=>'Conference Call', '4'=>'Meet in Fundraiser Office'); ?>
    <section class="inner-pages">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <h2 class="title">LondCap <span>Mail</span></h2>
                    <div class="sidebar-menu">
                        <ul>
                            <li class="active"><a href="{{url('User/message')}}" id="inbox-div">Inbox</a></li>
                            <li><a href="{{url('User/message')}}" id="outbox-div">Outbox</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                    <div class="messages-content">
                        <div class="messages-header clearfix">
                            <!-- <ul class="actions">
                                <li class="compose"><a href="#" class="btn btn-compose">+ Compose New</a></li>
                                <li class="delete"><a href="#">Delete</a></li>
                                <li class="mark-unread"><a href="#">Mark Unread</a></li>
                            </ul> -->
                        </div><!-- .messages-header -->
                     <div  id="inbox">
                        <!-- <div class="user-messaging-empty" >
                            <p>You have no messages</p>
                        </div> -->
                        <form method="post" id="message_formsend">
                          <div class="mesg-head">
                            <h3>Subject</h3>
                            <!-- Please take part in my survey -->      
                          </div>
                          <table cellspacing="0" cellpadding="0" border="0" class="messages">
                            <tbody>
                              <?php  $userID = Session::get('User.id'); ?>
                             @foreach($data as $row)
                              <tr>
                                <td class="avatar">
                                  <?php 
                                  $UserImg= 'images/user.png';
                                  if($userID != @$row['inbox_img_inv']['userid']){
                                    if(!empty(@$row['inbox_img_inv']['image_name'])){
                                      $UserImg= 'uploads/images/'.$row['inbox_img_inv']['image_name'];
                                    }
                                  }else if($userID != @$row['outbox_img_comp']['userid']){
                                    if(!empty(@$row['outbox_img_comp']['image_name'])){
                                      $UserImg= 'uploads/images/'.$row['outbox_img_comp']['image_name'];
                                    }
                                  }

                                  //print_r($row);
                                  ?>
                                  <img class="view-message" rel="177391" src="{{ asset($UserImg)}}" alt="User">
                                </td>
                                <td class="envelope view-message" rel="">
                                  <a href="javascript:;" class="view-message" rel="">
                                    <span class="sender">{{ @$row['inboxuser']['firstname'] }}</span>
                                  </a>
                                  <?php if($row['type']==1){?>
                                  <p><b>Meeting Request</b><br>Reserved Amount : {{ @$row['reserve_amount'] }}<br>Message  : {{ @$row['message'] }}<br>Meeting Type  : {{ $requestMaster[$row['meeting_at']] }}</p>
                                  <?php }else{ ?>
                                  <p>{{ @$row['message'] }}</p>
                                  <?php } ?>
                                </td>
                                <td class="meta">
                                  <span class="timestamp">
                                    {{ $row['created_at']}}
                                  </span>
                                   </td>
                              </tr>
                              @endforeach
                              {{Form::open(['method'=>'post','class'=>'sendData'])}}
                                <tr>
                                <td class="avatar">
                                  <span class="sender"><?php echo Session::get('User.firstname')." ".Session::get('User.lastname') ?> </span>
                                  <input type="hidden" id="userid" value="{{ @$row['inboxuser']['id']}}">
                                  <!-- <img class="view-message" rel="177391" src="http://localhost:8082/crowdfund/public/images/people.jpg" alt="User"> -->
                                </td>
                                <input type="hidden" name="sender_id" value="">
                                <td class="envelope view-message" rel="">
                                  <textarea class="form-control" id = "message" name="message" placeholder="Enter Your Message" rows="2"></textarea>
                                </td>
                                <td class="meta">
                                  <div class=" signup_btn"><a id="postData" class="nav-link" href="">Send</button></a>
                                </td>
                              </tr>
                              {{Form::close()}}
                          </tbody>
                        </table>
                          
                          
                          <input type="hidden" name="message_id" id="message_senderid" value="">
                          <input type="hidden" value="">
                        </form>
                        <div class="row">
                <div class="col-md-12">
                    <!-- <nav aria-label="Page navigation example">
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
                    </nav> -->
                </div>
            </div>
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
            <form class="form">
                <div class="form-group">
    <input type="email" class="form-control" placeholder="To:">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Subject:">
                </div><div class="form-group">
    <textarea class="form-control" rows="6" placeholder="Message:"></textarea>
                </div>
  <button type="submit" class="btn btn-primary">Send Message</button>
            </form><!-- #quick-message-send -->
        </div><!-- user-message-content -->
    </div>
        <script>
       /*$("#outbox-div").click(function() {
           $("#outbox").css("display","block")
       });
         $("#outbox-div").click(function() {
           $("#inbox").css("display","none")
       }); 
            $("#inbox-div").click(function() {
           $("#inbox").css("display","block")
       });
         $("#inbox-div").click(function() {
           $("#outbox").css("display","none")
       });*/
    </script>
    <script>
      $(document).ready(function(){
        $("a#postData").click(function(e)
        {
          
          var data = $('textarea#message').val();
          var userid = $("#userid").val();
          var reciever_id = $()     
           $(".sendData").submit();
            e.preventDefault();

            $.ajax({
              method:"POST",
              url:"{{ url('User/postMsg') }}",
              data:{"_token": "{{ csrf_token() }}",data:data,userid:userid},
              success:function(response){
                if(response.msg == "Success"){
                  window.location.href="{{ url('User/message')}}";
                }
              }
            })
          })
      });
    </script>
    @endsection