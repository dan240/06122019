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
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
                       		<input type="hidden" name="hosted_button_id" value="P3PL97JUSTKFJ">
							<ul class="price">
								<li class="header">Plus
								<li><strong>$100/month</strong></li>
								<li><input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!"></li>
							</ul>
                        	<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                      </form>
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