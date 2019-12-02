@extends('layouts.investor')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.min.css" />
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<style type="text/css">
	.sidebar-menu ul li a {
	padding: 0px;
	}
	.sidebar-menu .outbox_div .avatar { 
	padding: 5px 0px 0px 5px;
	width: 50px;
	}
	td.meta-col {
	font-size: 12px;
	color: #252525;
	line-height: 1.5em;
	padding: 0px 0px !important;
	vertical-align: top;
	text-align: left;
	width: 200px;
	}
	.outbox_div .meta {
	vertical-align: top;
	}
	.sidebar-menu .outbox_div table, .sidebar-menu .outbox_div table {
	border: 0px !important;
	}
	.sidebar-menu .outbox_div tr {
	border-bottom: 0px solid #b1b1b1;
	background: #f8f9f9;
	}
	td.envelope.view-message p {
	margin-bottom: 0px;
	}
	.sidebar-menu td.envelope.view-message {
	padding: 0px;
	vertical-align: top;
	padding-top: 5px;
	}
	td.envelope.view-message {
	padding: 0px 10px;
	}
	.outbox_div .meta .signup_btn {
	margin: 20px 0px;
	}
	.outbox_div .avatar img {
	width: 30px;
	height: 30px;
	border-radius: 100%;
	vertical-align: middle;
	}
	.sidebar-menu .outbox_div .meta, #inbox .meta {
	padding: 0px;
	}
	.outbox_div table, #inbox table {
	min-height: 75px;
	}
	.sidebar-menu .outbox_div .meta, #inbox .meta {
	padding: 5px 10px;
	}
	table.messages.recent-mesg, .recent-mesg .sender {
	    font-weight: 700;
	}
	.outbox_div .avatar, #inbox .avatar{
		padding: 0px 14px 0px 23px;
	}
	.outbox_div .meta, #inbox .meta{
		padding: 6px 8px;
	}
	.entire-convo-div{
		margin-bottom: 20px;
	}
	span.sender {
		color: #0272af;
		font-size: 14px;
	}
	#messageBox > td.envelope.view-message > p{
		font-size: 13px;
	}
</style>
<section class="inner-pages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top: 30px;">
				<input type="search" name="search" class="form-control" placeholder="Search for name" id="searchName">
				<!-- <h2 class="title">LondCap <span>Mail</span></h2> -->
				<br>
				<div class="sidebar-menu">
					<ul id="SortConversation">
						<?php
							foreach ($UserList as $key => $value) {
								$msg = app('App\Http\Controllers\UserController')->GetLastMessage($value['id']);
								$lmsg = json_decode($msg, true);
						?>
						<li class="outbox_div " data-name="<?php echo time()- strtotime($lmsg['created_at']); ?>">
							<a href="javascript:;" data-user="{{ $value['id']}}" class="MessageConversation">
								<?php 
									$userId = Session::get('User.id');
									$unread = 0;

									if($lmsg['reciever_id']==$userId && $lmsg['notify']==1){
										$unread = 1;
									}
								?>
								<table cellspacing="0" cellpadding="0" border="0" class="messages {{ ($unread==1 )? 'recent-mesg' : ''}}">
									<tbody>
										<tr>
											<td class="avatar">
												<?php
													if(!empty($value['investor_detail'])){
														$profileImg = $value['investor_detail']['image_name'];
													}else if(!empty($value['company_detail'])){
														$profileImg = $value['company_detail']['image_name'];
													}

													if($profileImg != '' && file_exists('./uploads/images/'.$profileImg)){
														$profileImg = url('/').'/uploads/images/'.$profileImg;
														
													}else{
														$profileImg = url('/').'/images/user.png';
													}
												?>
												<img class="view-message" rel="177391" src="{{ $profileImg }}" alt="User">
											</td>
											<td class="envelope view-message" rel="177391">
												<a href="javascript:;" class="view-message " rel="177391">
													<span class="sender lmsg-spn"><?php echo $value['firstname']." ".$value['lastname']; ?></span>
												</a>
												<div class="lmsg-spn">
												<?php 
													if($lmsg['type']==1){ echo 'Meeting'; }else{ echo 'Message'; }
													echo  $lmsg['subject'];
													echo " : <br> ";
													if(strlen($lmsg['message']) > 16){
														echo substr($lmsg['message'],0,16).' ...';
													}else{ echo $lmsg['message']; }
												?>
												</div>
											</td>
											<td class="meta">
												<span class="timestamp">
													<?php 
														$created_date = date('m/d/Y', strtotime($lmsg['created_at']));
														$today_date = date('m/d/Y');
														if($created_date != $today_date){ echo $created_date; }
													?>
												</span>
											</td>
											<td class="meta">
												<span class="timestamp">
													<?php echo date('h:i A', strtotime($lmsg['created_at']));?>
												</span>
											</td>
											
										</tr>
										<tr>
											
											<td >
												
											</td>
										</tr>
										<!-- <tr>
											<td class="meta">
												
											</td>
											<td class="meta-col" colspan="3">
												
											</td>
										</tr> -->
									</tbody>
								</table>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" style="margin-top: -18px;">
				<div class="messages-content" >
					<div class="messages-header clearfix">
						<ul class="actions">
							<li class="compose"><a href="#" class="btn btn-compose">+ Compose New</a></li>
							<!-- <li class="delete"><a href="#">Delete</a></li>
							<li class="mark-unread"><a href="#">Mark Unread</a></li> -->
						</ul>
					</div>
				</div>
				<div  id="inbox" >
					<div class="user-messaging-empty" >
						<p>You have no messages</p>
					</div>
					<div class="row">
						<div class="col-md-12">
						</div>
					</div>
				</div>
				<div class="outbox_div" id="outbox" style="display: none">
					<form method="post" id="message_form">
						<input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
						<div class="mesg-head" style="display :none">
							<h3>Subject</h3>
							Start Text Message
						</div>
						<div class="entire-convo-div" id="entire-convo-div">
							<table cellspacing="0" cellpadding="0" border="0" class="messages">
								<tbody id="messageBox">
									
								</tbody>
							</table>
						</div>
						
						<div>
							<table cellspacing="0" cellpadding="0" border="0">
								<tbody id="sendBox">
									
								</tbody>
							</table>
						</div>	
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
				$('.MessageConversation').first().trigger('click');
			},100);

			$('.MessageConversation').on('click', function() {
				var otherId = $(this).data('user');

				$(this).children('.messages').removeClass('recent-mesg');
				$('.outbox_div').removeClass('active');
				$(this).parent('.outbox_div').addClass('active');

				$.ajax({
					method:"GET",
					url: "{{ url('GetMessageHistory/') }}/"+otherId,
					async:false,
					success:function(response) {
						var response = JSON.parse(response);
						
						$('#inbox').hide();

						$('#messageBox').html(response.messages);
						
						$('#sendBox').html(response.sendbox);
						
						$('#outbox').show();
						
						var objDiv = document.getElementById("entire-convo-div");
						
						objDiv.scrollTop = objDiv.scrollHeight;

						updateMessageNotifications();
					}
				});
			});
			
			$('body').on('click', '.signup_btn', function(e) {
				e.preventDefault();

				$.ajax({
					method:"POST",
					url: "{{ url('/User/postMsg') }}",
					async:false,
					data:$('#message_form').serialize(),
					success:function(response) {
						if (response.code ==1) {
							$('body').find('.message_box').val('');
							$( response.data ).insertAfter( "#messageBox>tr:last" );
							var objDiv = document.getElementById("entire-convo-div");
							objDiv.scrollTop = objDiv.scrollHeight;
						} else if(response.code == 2 && response.msg == 'msglimit'){
							swal({
					            title: "Your free trail message limit has been exceeded. Please renew your account to get unlimited access.",
					            text: "",
					            type: "warning",
					            showCancelButton: false,
					            showConfirmButton : false,
					            confirmButtonColor: "#DD6B55",
					            confirmButtonText: "ok!",
					            },function(){
									window.location = "{{ url('/User/fundraising') }}";
					        });
							
							
						}else if(response.code == 2 && response.msg == 'notApproved'){
							swal({
					            title: "You can send messages / meeting requests once yuor account has been approved",
					            text: "",
					            type: "warning",
					            showCancelButton: false,
					            showConfirmButton : false,
					            confirmButtonColor: "#DD6B55",
					            confirmButtonText: "ok!",
					            },function(){
					        });
						}
					}
				});
			});

			$('body').on('click', '#send', function(e){
				$(".se-pre-con").fadeIn("slow");
					e.preventDefault();
					
					$.ajax({
						method:"POST",
						url: "{{ url('/User/sendUserMessage') }}",
						async:false,
						data:$('.chatNewBox').serialize(),
						success:function(response) {
							if (response.code == 1) {
								swal('Message sent successfully');
								$(".new-message").css("display","none");
							}
						}
					});
				$(".se-pre-con").fadeOut("slow");
			});

			$(".btn-compose").click(function () {
	           $(".new-message").css("display","block")
	        });
	    
	        $(".message-close").click(function () {
	           $(".new-message").css("display","none")
			});
			
	        BindControls();
		})

		function BindControls() {
	        $.ajax({
	            method:"POST",
	            url:"{{url('User/findNamelist')}}",
	            data:{"_token":"{{csrf_token()}}"},
	            success:function(response)
	            {
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
</section>

<div class="new-message" style="display: none;">
    <div class="user-message-header">
        <h2>New Message</h2>
        <a href="#" class="message-close">x</a>
    </div><!-- .user-message-header -->
    <div class="user-message-content">
        {{Form::open(['class'=>'form chatNewBox','method'=>'post'])}}
                <div class="checkbox" style="display: none">
                    <label><input type="checkbox" name="interested" value="1" checked> Message Followers</label>
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
$(document).ready(function(){
	var $wrapper = $('#SortConversation');

	$wrapper.find('.outbox_div').sort(function (a, b) {
	        return +a.dataset.name - +b.dataset.name;
	    })
	    .appendTo($wrapper);
	});

	$('#searchName').on('keyup keydown', function () {

		var input, filter, ul, li, txtValue, a, i;
		
	    input = document.getElementById("searchName");
	    filter = input.value.toUpperCase();
	    ul = document.getElementById("SortConversation");
		li = ul.getElementsByTagName("li");
		
	    for (i = 0; i < li.length; i++) {
	        a = li[i].getElementsByTagName("a")[0];
			txtValue = a.textContent || a.innerText;
			
	        if (txtValue.toUpperCase().indexOf(filter) > -1) {
	            li[i].style.display = "";
	        } else {
	            li[i].style.display = "none";
	        }
	    }
	});
</script>
@endsection