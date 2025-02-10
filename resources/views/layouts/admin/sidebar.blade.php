<aside class="left-sidebar bg-dark">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
          <img src="{{asset ('Admin/assets/images/ass.png')}}" width="100" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8" style="color: white"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu" style="color: white">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Dashboard</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu" style="color: white">More Table</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-category" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Category</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('penulis.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-writing" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Writter</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('penerbit.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-user" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Publisher</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('buku.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-book" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Book</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu" style="color: white">Submission</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('peminjamanadmin.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-building-bank" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">Apply for a loan</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu" style="color: white">Plus User</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('user.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-mood-happy" style="color: white"></i>
              </span>
              <span class="hide-menu" style="color: white">User</span>
            </a>
          </li>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->
