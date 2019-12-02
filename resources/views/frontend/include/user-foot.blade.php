 <!-- Container (Footer) -->
 <footer class="footer_in">
        <div class="container">
            <div class="footer-pages">
                <div class="column">

                    <ul>
                        <li class="heading">Getting Started</li>
                        <li><a href="{{ url('/User/get-funded') }}" id="getfunded">Get Funded</a></li>
                        <li><a href="{{ url('/User/how-it-works') }}" id="howitwork">How It Works</a></li>
                        <li><a href="{{url('User/signupForm')}}" id ="userSignup">Sign Up</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#exampleModalLong">Log In</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Browse</li>
                        <li><a href="{{url('User/index')}}">Browse Companies</a></li>
                        <li><a href="{{url('User/index')}}">Companies</a></li>
                        <li><a href="{{url('User/people')}}">People</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Legal</li>
                        <li><a href="{{url('User/terms-of-use')}}" id="termsofuse">Terms of Use</a></li>
                        <li><a href="{{url('User/privacy_policy')}}" id="privacy_policy">Privacy Policy</a></li>
                        <li><a href="{{url('User/testimonial')}}">Testimonial</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Browse</li>
                        <li><a href="{{url('User/aboutus')}}">About</a></li>
                        <li><a href="{{url('User/news-and-events')}}">News &amp; Events</a></li>
                        <li><a href="{{url('User/blog')}}">Blog</a></li>
                        <li><a href="{{url('User/support')}}">Support</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">
                    <ul>
                        <li class="heading">Londcap</li>
                        <li><a href="{{url('User/newsletter')}}">Newsletter</a></li>
                        <li><a href="{{url('User/investor-faq')}}">Investor FAQ</a></li>
                        <li><a href="{{url('User/knowledge-center')}}">Knowledge Center</a></li>
                    </ul>
                </div><!-- end .column -->
            </div>
            <div class="notices clearfix">
                <img src="{{ asset('images/Logo%20LondCap.png')}}" style="margin: 0 auto; display: block">
                <p class="copyright">Copyright © 2019 LondCap.com. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script>
        $(document).ready(function(){
            $("#signup").click(function(){
                window.location.href = "{{url('User/signup')}}"
            });
            $("#termsofuse").click(function(){
                window.location.href = "{{url('User/termsofuse')}}"
            }); 
            $("#privacy_policy").click(function(){
                window.location.href = "{{url('User/privacy_policy')}}"
            }); 
        });

    </script>
    <script type="text/javascript">
        $(document).ajaxStart(function() {
          //$(".se-pre-con").fadeIn("slow");
        });

        $( document ).ajaxStop(function() {
          //$(".se-pre-con").fadeOut("slow");
        });
    </script>
<script src="{{ url('js/jquery.validate.min.js')}}"></script>