@extends('layouts.home')
@section('content')
    <section class="contact_page">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10 col-sm-10 col-xs-12 col-md-offset-1">
        <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
            <div class="contact_info">
            <address>
                <h4>Address</h4>
                
                <p>33 Floor,</p>                     
                 <p>25 Canada Square,</p>     
                 <p>London, E14 5LQ,</p>     
                 <p>United Kingdom</p>
                <hr style="border-top: 2px dotted #f2f2f2;">
                <h4>Telephone</h4>
                <p>+123 - 127384985439</p> 
                 <hr style="border-top: 2px dotted #f2f2f2;">
</address>
                <img src="{{ asset('images/address.jpg')}}" class="img-responsive"/>
            </div>
            </div>
             <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">
            <div class="contact_form">
                 <form action="" class="login-container">
                    <form-group>
                        <input type="text" placeholder=" First Name" name="name" required="">
                    </form-group>
                     <form-group>
                        <input type="text" placeholder=" Last Name" name="name" required="">
                    </form-group>
                     <form-group>
                        <input type="email" placeholder="Busniess Email" name="email" required="">
                    </form-group>
                    <form-group>
                        <input type="text" placeholder="Phone Number" name="pnumber" required="">
                    </form-group>
                     <form-group>
                     <textarea rows="3" cols="45" placeholder="Address"></textarea>
                                 </form-group>
                   <form-group>
                     <textarea rows="7" cols="45" placeholder="Message/Query"></textarea>
                                 </form-group>
             
                    <button type="submit" class="btn">Send</button>
                    
                </form>
                 </div>     
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection