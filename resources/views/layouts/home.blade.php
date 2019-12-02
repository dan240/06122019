<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontend.include.user-head')

</head>

<body>
    @include('frontend.include.user-header')

    @yield('content')
   
    @include('frontend.include.user-foot')

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
</body>

</html>