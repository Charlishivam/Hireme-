<nav id="sidebar" class="sidebar-wrapper">
  <div class="sidebar-content">
    <div class="sidebar-brand">
      <a href="#">
        <img class="logo-side" src="<?php echo asset('frontend/img/logo.png') ?>" />
      </a>
      <div id="close-sidebar">
        <i class='bx bx-x'></i>
      </div>
    </div>
    <div class="sidebar-header">
      <div class="user-pic">
        <img class="img-responsive img-rounded" src="<?php echo asset('backend/img/user.jpg') ?>" alt="User picture">
      </div>
      <div class="user-info">
        <span class="user-name"><?php echo admin()->name ?>
        </span>
        <span class="user-role">Administrator</span>
        <span class="user-status">
          <i class='bx bxs-circle text-success'></i>
          <span>Online</span>
        </span>
      </div>
    </div>
    <div class="sidebar-menu">
      <ul>
        <li class="header-menu">
          <span>General</span>
        </li>
        <li class="current">
          <a href="<?php echo base_url('secure/dashboard') ?>">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-dropdown">
          <a href="#">
            <i class='bx bxs-user-account'></i>
            <span>Users</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="<?php echo base_url('secure/user/users') ?>">User list</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="sidebar-dropdown">
          <a href="#">
            <i class='bx bxs-star'></i>
            <span>Category</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="<?php echo base_url('secure/category') ?>">Category list</a>
              </li>
              <li>
                <a href="<?php echo base_url('secure/category/create') ?>">Add Category</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="sidebar-dropdown">
          <a href="#">
            <i class='bx bxs-tag'></i>
            <span>Tag</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
               <li>
                <a href="<?php echo base_url('secure/tag') ?>">Tag list</a>
              </li>
              <li>
                <a href="<?php echo base_url('secure/tag/create') ?>">Add Tag</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="sidebar-dropdown">
          <a href="#">
            <i class='bx bxs-layer'></i>
            <span>Template</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="<?php echo base_url('secure/template') ?>">Template list</a>
              </li>
              <li>
                <a href="<?php echo base_url('secure/template/create') ?>">Add Template</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <!-- sidebar-menu  -->
  </div>
</nav>