    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
       <a class="navbar-brand" id="home" href="{{ url('Admin/dashboard')}}"><img src="{{ asset('images/Logo%20LondCap.png')}}" /></a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <!-- <li class="nav-item px-3">
          <a class="nav-link" href="{{ url('Admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="{{ url('Admin/User')}}">Users</a>
        </li> -->
        <!-- <li class="nav-item px-3">
          <a class="nav-link" href="#">Settings</a>
        </li> -->
      </ul>
      <ul class="nav navbar-nav ml-auto">
        <!-- <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-bell"></i>
            <span class="badge badge-pill badge-danger">5</span>
          </a>
        </li> -->
        <!-- <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-list"></i>
          </a>
        </li> -->
        <!-- <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-location-pin"></i>
          </a>
        </li> -->
        <li class="nav-item dropdown admin-data">
          <a class="nav-link"  onclick="myFunction()"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
         <img class="img-avatar" src="{{ asset('admin/img/avatars/6.jpg')}}" alt="admin@bootstrapmaster.com">
          </a>
          <div id="myDropdown" class="dropdown-content">  
              
            <a class="dropdown-item" href="#">
              <i class="fa fa-user"></i> Profile</a>
           <!--  <a class="dropdown-item" href="#">
              <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-usd"></i> Payments
              <span class="badge badge-secondary">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-file"></i> Projects
              <span class="badge badge-primary">42</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-shield"></i> Lock Account</a> -->
            <a class="dropdown-item" href="{{ url('Admin/logout')}}">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
    <div class="se-pre-con" style="background: url(<?php echo url('/'); ?>/images/giphy.gif) center no-repeat #fff;"></div>
<style> 
  .admin-data .dropdown-content { display: none; position: absolute; right: 0px; background-color: #fff;
    min-width: 160px; overflow: auto; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;
    text-align: left; }
  .admin-data .dropdown-content a { color: black; padding: 12px 20px; text-decoration: none; display: block; }
  .admin-data .dropdown a:hover {background-color: #ddd;}
  .admin-data .show {display: block;}
  .no-js #loader { display: none;  }
  .js #loader { display: block; position: absolute; left: 100px; top: 0; }
  .se-pre-con { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999;
    /* display: none; */ }
</style>
<script>
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
</script>