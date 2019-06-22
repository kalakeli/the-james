<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>The James CMS</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="./../images/avatar_james.jpg" alt="The James Avatar" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">The James CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <router-link to="/beerstyles" class="nav-link">
              <i class="nav-icon fas fa-beer"></i>
              <p>
                Beerstyles
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/breweries" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Breweries
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/beers" class="nav-link">
              <i class="nav-icon fas fa-beer"></i>
              <p>
                Beers
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/spirits" class="nav-link">
              <i class="nav-icon fas fa-wine-glass-alt"></i>
              <p>
                Wines & Spirits
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/events" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Events
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/glossary" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Glossary
              </p>
            </router-link>
          </li>
          <hr>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link red"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off red"></i>
              {{ __('Logout') }}
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h1 class="m-0 text-dark">Content-Management</h1>
            <p>Hier könnt ihr die aus der Datenbank gelesenen Inhalte einpflegen,
              also die Bier-Typen, Biere, Brauereien, Weine und Whiskeys etc. und
              Veranstaltungen eingeben.</p>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">

            <!-- route outlet -->
            <!-- component matched by the route will render here -->
            <router-view></router-view>
            <!-- set progressbar -->
            <vue-progress-bar></vue-progress-bar>

          </div>
          <!-- /.col-lg-12 -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <img src="./images/kb_hund.svg" alt="Logo Karsten Berlin" style="width:32px;height:auto;" class="img-circle img-fluid">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.karsten-berlin.net/" target="_blank">karsten berlin</a></strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
