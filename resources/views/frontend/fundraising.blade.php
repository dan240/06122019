@extends('layouts.home')
@section('content')
    <section class="inner-pages fundraising">
        <div class="container">
            <div class="row">
                  <div class="text-center" style="width: 100%">
                    @if(!empty($reason))
                      <div class="alert alert-info">
                        <strong>{{ $reason }}</strong>
                      </div>
                    @endif
                  </div>

                <h4 class="text-center">Choose the best solution for you!</h4>
                    <div class="columns">
                    </div>
                    <div class="columns">
                      <ul class="price">
                        <li class="header">Plus
                          <p>Lorem Ipsum is simply dummy text.</p></li>
                        <li class="grey"><a href="https://www.paypal.com" class="button">Select Plus</a></li>
                        <li><strong>$49.99/month*</strong></li>
                         <li><i class="fas fa-check"></i> Lorem Ipsum is simply dummy text lorem Ipsum is simply</li>
                        <li><i class="fas fa-check"></i> Lorem Ipsum is simply dummy text lorem Ipsum </li>
                        <li><i class="fas fa-check"></i> Lorem Ipsum is simply dummy text lorem Ipsum is simply</li>
                           <li><i class="fas fa-check"></i> Lorem Ipsum is simply dummy text lorem Ipsum is simply</li>
                      </ul>
                    </div>
                <div class="columns">
                </div>

            </div>
        </div>
    </section>
    <script>
      function myFunction1() {
          var txt;
          var r = confirm("Are you confirm to make payment");
          if (r == true) {
            window.location.href="https://www.paypal.com";
          } else {
            return false;
          }
        }
        function myFunction2() {
          var txt;
          var r = confirm("Are you confirm to make payment");
          if (r == true) {
            window.location.href="https://www.paypal.com";
          } else {
            return false;
          }
        }
        function myFunction3() {
          var txt;
          var r = confirm("Are you confirm to make payment");
          if (r == true) {
            window.location.href="https://www.paypal.com";
          } else {
            return false;
          }
        }
    </script>
     @endsection