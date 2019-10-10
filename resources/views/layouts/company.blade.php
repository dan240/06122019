<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l1 sidebar-r1-xs" lang="en">
<head>
  @include('frontend.include.user-head')
  
</head>

<body>

    @include('frontend.include.user-header')
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
    
      @yield('content')


  <!-- Inline Script for colors and config objects; used by various external scripts; -->
  @include('frontend.include.user-foot')

</body>

</html>