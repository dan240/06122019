<!DOCTYPE html>
<html lang="en">

<head>
  <?php echo $__env->make('frontend.include.user-head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>
    
        
        <?php echo $__env->make('frontend.include.user-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-------------------------nav-end------------------------------>

    <?php echo $__env->yieldContent('content'); ?>
   

    <!-- Container (Footer) -->
     <?php echo $__env->make('frontend.include.user-foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <!-----------------------header-sticky-scripts---------------------------->
<!--     <script>
       
        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script> -->

    

</body>

</html><?php /**PATH D:\Lond Capital\Site\londcapapp\resources\views/layouts/home.blade.php ENDPATH**/ ?>