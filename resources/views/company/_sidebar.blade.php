<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
      <a href="#" style="font-size: 30px">
        {{ env('APP_NAME') }}
      </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
      <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">

          <li>
            <a href="{{ route('company.dashboard') }}">
              <i class="fas fa-tachometer-alt"></i>Dashboard</a>
          </li>

          <li class="has-sub">
            <a class="js-arrow" href="#">
              <i class="fas fa-laptop"></i>Projects <i class="fas fa-chevron-down" style="float: right;margin-top: 5px;"></i> </a>
            <ul class="list-unstyled navbar__sub-list js-sub-list">
              <li>
                <a href="{{ route('company.projects.index') }}">All Projects</a>
              </li>
              <li>
                <a href="{{ route('company.projects.create') }}">Add New</a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>
  <!-- END MENU SIDEBAR-->
