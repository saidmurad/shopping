<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Shopping</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom/main.css">
    
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM
      <div >
        <input >
        <div >
          <button >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div> -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="custom-sidebar main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p  class="brand-link">
      <!-- <img src="./img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="custom-title brand-text font-weight-light "><span> HABESHA</span> <br>  SUPERMARKET</span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
          <img src="{{asset('./storage/users/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
                <p class="custom-username font-weight-bold"><span>{{Auth::user()->firstName}} </span>{{Auth::user()->lastName}}</p>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
            <router-link to="/customerHome" class="nav-link">
            <i class="nav-icon fas fa-home" style="color: #ffd36f;"></i>
                <p class="custom-navlink">
                Home

                </p>
            </router-link>
            </li>

            <li class="nav-item">
            <router-link to="/cartItems?id={{Auth::user()->id}}" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart" style="color: #ffd36f;"></i>
                <p class="custom-navlink">
                Cart Items

                </p>
            </router-link>
            </li>

            
            <li class="nav-item">
            <!-- <router-link to= "nn" class="nav-link"> -->
            <router-link to="/customerViewCategory?id={{Auth::user()->id}}" class="nav-link">
            <i class="nav-icon fas fa-store" style="color: #ffd36f;"></i>
                <p class="custom-navlink">
                View Category
               
                </p>
            </router-link>
            </li>
           
         

         <li class="nav-item">
                <router-link to="/profile?id={{Auth::user()->id}}" class="nav-link">
                    <i class="nav-icon fas fa-user orange" style="color: #ffd36f;"></i>
                    <p class="custom-navlink">
                        Profile
                    </p>
                </router-link>
         </li>


          <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="nav-icon fa fa-power-off red" style="color: #ffd36f;"></i>
                    <p class="custom-navlink">
                        {{ __('Logout') }}
                    </p>
                 </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>

        <!-- <vue-progress-bar></vue-progress-bar> -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 </strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<script src="/js/app.js"></script>
</body>
</html>
