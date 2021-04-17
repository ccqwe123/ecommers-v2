
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminPanel | @yield('adtitle')</title>
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
  <style type="text/css">
  .navbar-white {
      background-color: #fff;
  }
  </style>
</head>
<body class="sidebar-mini layout-navbar-fixed">
<div class="wrapper"  id="app">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell fa-lg"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">0 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
  	
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="z-index: 1;">
    <a href="/" class="brand-link">
      <img src="/images/others/bdlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BeautyDerm</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/others/photo-1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	<li class="nav-item">
              <router-link to="/dashboard" class="nav-link">
              		<i class="fas fa-tachometer-alt nav-icon"></i>
		              <p>Dashboard</p>
              </router-link>
         	</li>
            <li class="nav-item">
              <router-link to="/products" class="nav-link">
                  <i class="fas fa-shopping-bag nav-icon"></i>
                  <p>Products</p>
              </router-link>
          </li>
          	<li class="nav-item">
              <router-link to="/orders" class="nav-link">
              		<i class="fas fa-dolly-flatbed  nav-icon"></i>
		              <p>Orders</p>
            	</router-link>
         	</li>
          	<li class="nav-item">
              <router-link to="/category" class="nav-link">
              		<i class="fas fa-boxes nav-icon"></i>
		              <p>Category</p>
            	</router-link>
         	</li>

          	<li class="nav-item">
              <router-link to="/users" class="nav-link">
              		<i class="fas fa-users nav-icon"></i>
		              <p>Users</p>
            	</router-link>
         	</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Banner
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/main-banner" class="nav-link">
                  <i class="fas fa-folder"></i>
                  <p>Main Banner</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/product-banner" class="nav-link">
                  <i class="fas fa-folder"></i>
                  <p>Latest Product</p>
                  </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/product-category-banner" class="nav-link">
                  <i class="fas fa-folder"></i>
                  <p>Product Category</p>
                  </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (\Request::route()->getName() == 'admin.banner' || \Request::route()->getName() == 'admin.on-sale') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
              	Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/banner" class="nav-link {{ Request::url() == url('/banner') ? 'active' : '' }}">
                  <i class="fas fa-images nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                	<i class="fas fa-clock nav-icon"></i>
                  <p>On Sale</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
          	<a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"><i class="fas fa-sign-out-alt nav-icon" aria-hidden="true"></i>{{ __('Logout') }} </a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
         	</li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
        <router-view></router-view>
  </div>
</div>

<script src="/js/app.js"></script>

</body>
</html>
