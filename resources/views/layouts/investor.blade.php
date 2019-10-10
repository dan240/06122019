<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontend.include.user-head')

</head>

<body>
    
        
        @include('frontend.include.user-header-investor')

    
    <!-------------------------nav-end------------------------------>

    @yield('content')
   

    <!-- Container (Footer) -->
     @include('frontend.include.user-foot')

    
    
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <!-----------------------header-sticky-scripts---------------------------->
    <script>
        $(document).ready(function(){
            myFunction();
        })
        
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
    </script>

    

</body>

</html>