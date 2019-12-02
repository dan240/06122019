  <!--    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/pace-progress/pace.min.js"></script>-->
    <script src="{{ url('admin/vendors/@coreui/coreui-pro/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
    <!-- <script src="{{ url('admin/js/charts.js')}}"></script>
     --><script src="{{ url('admin/js/tooltips.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <!-- <script src="{{ url('admin/js/main.js')}}"></script> -->

    <script type="text/javascript">
    	$( document ).ajaxStart(function() {
        $(".se-pre-con").fadeIn("slow");
      });

		$( document ).ajaxStop(function() {
		  $(".se-pre-con").fadeOut("slow");
    });
    
    $(window).on('load', function(){
      $(".se-pre-con").fadeOut("slow");
    });

    </script>