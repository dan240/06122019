 <!-- Container (Footer) -->
 <footer class="footer_in">
        <div class="container">
            <div class="footer-pages">
                <div class="column">

                    <ul>
                        <li class="heading">Getting Started</li>
                        <li><a href="<?php echo e(url('/User/get-funded')); ?>" id="getfunded">Get Funded</a></li>
                        <li><a href="<?php echo e(url('/User/how-it-works')); ?>" id="howitwork">How It Works</a></li>
                        <li><a href="<?php echo e(url('User/signupForm')); ?>" id ="userSignup">Sign Up</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#exampleModalLong">Log In</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Browse</li>
                        <li><a href="<?php echo e(url('User/index')); ?>">Browse Companies</a></li>
                        <li><a href="<?php echo e(url('User/index')); ?>">Companies</a></li>
                        <li><a href="<?php echo e(url('User/people')); ?>">People</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Legal</li>
                        <li><a href="<?php echo e(url('User/terms-of-use')); ?>" id="termsofuse">Terms of Use</a></li>
                        <li><a href="<?php echo e(url('User/privacy-policy')); ?>" id="privacy_policy">Privacy Policy</a></li>
                        <li><a href="<?php echo e(url('User/testimonial')); ?>">Testimonial</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">

                    <ul>
                        <li class="heading">Browse</li>
                        <li><a href="<?php echo e(url('User/aboutus')); ?>">About</a></li>
                        <li><a href="<?php echo e(url('User/events')); ?>">News &amp; Events</a></li>
                        <li><a href="<?php echo e(url('User/blog')); ?>">Blog</a></li>
                        <li><a href="<?php echo e(url('User/support')); ?>">Support</a></li>
                    </ul>
                </div><!-- end .column -->
                <div class="column">
                    <ul>
                        <li class="heading">Londcap</li>
                        <li><a href="<?php echo e(url('User/newsletter')); ?>">Newsletter</a></li>
                        <li><a href="<?php echo e(url('User/investor-faq')); ?>">Investor FAQ</a></li>
                        <li><a href="<?php echo e(url('User/knowledge-center')); ?>">Knowledge Center</a></li>
                    </ul>
                </div><!-- end .column -->
            </div>
            <div class="notices clearfix">
                <img src="<?php echo e(asset('images/Logo%20LondCap.png')); ?>" style="margin: 0 auto; display: block">
                <p class="copyright">Copyright © 2019 LondCap.com. All rights reserved.</p>
            </div>
            <div class="footer-message">
                <p><strong>DISCLOSURE</strong>: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy <a href="#" target="_blank">Terms of Use</a> and <a href="#" target="_blank">Privacy Policy</a>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."<a href="#" target="_blank" rel="nofollow">accredited investors</a>" Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took <a href="#" target="_blank" rel="nofollow">SEC</a> or <a href="#" target="_blank" rel="nofollow">FINRA</a>.</p>
            </div>
        </div>
    </footer>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script>
        $(document).ready(function(){
            $("#signup").click(function(){
                window.location.href = "<?php echo e(url('User/signup')); ?>"
            });
            $("#termsofuse").click(function(){
                window.location.href = "<?php echo e(url('User/termsofuse')); ?>"
            }); 
            $("#privacy_policy").click(function(){
                window.location.href = "<?php echo e(url('User/privacy_policy')); ?>"
            }); 
        });

    </script>
    <script type="text/javascript">
        $( document ).ajaxStart(function() {
          $(".se-pre-con").fadeIn("slow");
        });

        $( document ).ajaxStop(function() {
          $(".se-pre-con").fadeOut("slow");
        });
    </script>
<script src="<?php echo e(url('js/jquery.validate.min.js')); ?>"></script><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/include/user-foot.blade.php ENDPATH**/ ?>