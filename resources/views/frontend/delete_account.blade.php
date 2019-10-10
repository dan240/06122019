@extends('layouts.home')
@section('content')
    <section class="inner-pages">
        <div class="container">
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                    <a href="javascript:;" class="btn btn-danger" id="deleteComp">
                        Delete Account
                    </a>
                    <br><br><br>
                        <strong class="text-danger">YOU CAN CHANGE STATUS NOT LOOKING FOR INVESTMENT, AND DECIDE LATER IF YOU WANT TO ACTIVATE, INSETAD OF DELETING.</strong> 
                    <br><br><br>

                    @if($userType == '1')
                        <a href="javascript:;" class="btn btn-success" id="changeToNoInvestment">
                            Not Looking For Invesment
                        </a>
                    @else
                        <a href="javascript:;" class="btn btn-success" id="changeToNoInvestmentInv">
                            Not Looking For Invesment
                        </a>
                    @endif

                   
                </div>
            </div>

        </div>
    </section>

    <div class="modal" id="deleteAcc">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <strong class="text-danger">YOU CAN CHANGE STATUS NOT LOOKING FOR INVESTMENT, AND DECIDE LATER IF YOU WANT TO ACTIVATE, INSETAD OF DELETING.</strong> 
                <div class="text-center">
                    <a href="javascript:;" class="btn btn-success" id="changeToNoInvestment">Change status</a> 
                    <div class="text-danger">
                        <span id="noInvErr"></span>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>


    <script>
        
        $('#changeToNoInvestment').click(function(){
            $.ajax({
                method:"POST",
                url:"{{ url('User/changeToNoInvestment')}}",
                data: {"_token": "{{ csrf_token() }}"},
                cache: false,
                processData: false, 
                contentType: false,
                success:function(response){
                    if (response.msg == 'success') {
                        location.reload();
                    }else{
                        $('#noInvErr').html('Something Went Wrong !');
                    }
                }
            });
        });
        $('#changeToNoInvestmentInv').click(function(){
            $.ajax({
                method:"POST",
                url:"{{ url('User/changeToNoInvestmentInv')}}",
                data: {"_token": "{{ csrf_token() }}"},
                cache: false,
                processData: false, 
                contentType: false,
                success:function(response){
                    if (response.msg == 'success') {
                        location.reload();
                    }else{
                        $('#noInvErr').html('Something Went Wrong !');
                    }
                }
            });
        });


        $('#deleteComp').click(function(){
            $.ajax({
                method:"POST",
                url:"{{ url('User/deleteCompany')}}",
                data:{"_token": "{{ csrf_token() }}"},
                cache: false,
                processData: false, 
                contentType: false,
                success:function(response){
                    if (response.msg == 'success') {
                        location.reload();
                    }else{
                        $('#noInvErr').html('Something Went Wrong !');
                    }
                }
            });
        });
    </script>


@endsection