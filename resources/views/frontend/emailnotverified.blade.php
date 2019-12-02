@extends('layouts.home')
@section('content')
<style type="text/css">
  .padding{
    padding: 100px ; 
  }

  #email_verification_error, #email_verification_success {
	  display: none;
  }
</style>
<section class="inner_pages">
    <div class="container">
        <div class="row">
            <div class="col col-12 text-center padding">
                <div class="alert alert-light" role="alert">
                    <h4>Your email address is not yet verified.</h4>
                    <hr>
                    <h6>
                      Please check your mail inbox or spam folder for the verification email.
                    </h6>

                    @isset($user_email)
					<hr>
					<div id="email_verification_panel">
                    	<h6>Didn't receive the verification email?</h6>
                      	<form method="post" action="{{ url('/User/resendEmailCVerification') }}" id="email_verification_form">
							<input type="hidden" name="email" value="{{ $user_email }}" />

							<button class="btn btn-primary" type="submit" id="email_verification_btn">
								<span class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
								<span class="text">Resend Verification Email</span>
							</button>
                    	</form>
					</div>
					<div class="alert alert-success" role="alert" id="email_verification_success">
						Your verification email has been sent.
					</div>
					<div class="alert alert-danger" role="alert" id="email_verification_error">
						There was a problem while sending your verification email.
					</div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
	<script>
		$(document).ready(function() {
			$("#email_verification_form").submit(function(event) {
				var $form = $(this);
				var $email_verification_panel = $("#email_verification_panel");

				event.preventDefault();

				$("#email_verification_btn span.spinner").show();
				$("#email_verification_btn span.text").text("Sending");

				$.ajax({
					url: $form.attr("action"),
					type: "post",
					data: $form.serialize(),
					success: function() {
						$("#email_verification_panel").hide();
						$("#email_verification_success").show();
					},
					error: function() {
						$("#email_verification_panel").hide();
						$("#email_verification_error").show();
					}
				});	
			});
		});

	</script>
</section>
@endsection