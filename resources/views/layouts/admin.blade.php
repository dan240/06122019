<!DOCTYPE html>

<html lang="en">
  <head>
    @include('backend.include.head')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('backend.include.header')
    <div class="app-body">
    @include('backend.include.sidebar')
      <main class="main">
        
        @yield('content')
 
      </main>
    </div>
    @include('backend.include.footer')
    
    <!-- CoreUI and necessary plugins-->
      
      
      @include('backend.include.header')


    <!-- nav-end -->

    
   

    <!-- Container (Footer) -->
     @include('backend.include.foot')
  </body>
</html>
