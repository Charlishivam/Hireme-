<nav class="navbar navbar-expand-lg navbar-light custm-nav">
    <div class="container-fluid mw-1200 p-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-profile-dropdown mr-0">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="bx bx-user"></i> <?php echo admin()->name ?> </a>
                    <div class="dropdown-menu dropdown-menu-bt dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url('/BackendAuth/login/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>