<style>
  .no-underline {
    text-decoration: none;
}

.no-underline:hover {
    text-decoration: none;
}

</style>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard')}}" class="logo d-flex align-items-center no-underline">
        {{-- <img src="/img/logo.png" alt=""> --}}
        <div class="col-lg-2">
          <i class="fa fa-home" style="font-size: 1.9rem; color: #996600;"></i>
            {{-- <i class="fa-solid fa-mosque" style="color: #FFD43B;"></i> --}}
        </div>
        {{-- <i class="fa-solid fa-mosque" style="color: #FFD43B;"></i> --}}
        <span class="d-none d-lg-block">Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    
    <div class="search-bar" style="margin-top: 1.4em;">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div><!-- End Search Bar -->
  
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
  
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li><!-- End Search Icon-->
  
    
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        
        <li class="nav-item dropdown pe-3">
  
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->
  
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
                <form action="{{ route('logout') }}" method="POST" class="dropdown-item d-flex align-items-center">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
        <!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header>
  <!-- End Header -->
