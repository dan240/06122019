@extends('layouts.home')
@section('content')
    <!-------------------------nav-end------------------------------>
    <section class="login_page">
        <div class="container">
            <div class="row centered-container clearfix">
                {{ Form::open(array('method' => 'post','class' => 'login-container')) }}
                    <?php if(!empty($response)):?>
                        <div class="alert alert-<?php echo ($response['code'] == 1)?'success':'danger';?> alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <i class="icon fa fa-<?php echo ($response['code'] == 1)?'check':'ban';?>"></i>
                          <?php echo $response['msg'];?>
                        </div>
                      <?php endif; ?>
                    <h4 class="text-center">Forgot Password</h4>
                    <hr style="border-top: 2px dotted #eee;">
                    <form-group>
                        <p class="text-center">Please enter your email to reset your password</p>
                    </form-group>
                    <hr style="border-top: 2px dotted #eee;">
                    <form-group>
                        <input type="email" placeholder="Email" name="email" required="">
                    </form-group>
                   
                    <button type="submit" class="btn">Reset Password</button>
             
                {{ Form::close() }}
            </div>
        </div>
    </section>

   @endsection