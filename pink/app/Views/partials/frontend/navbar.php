<section class="top">
    <?php if (empty(user())) { ?>
    <div class="container top-info">
        <div class="row">
            <div class="col-md-6 d-none d-md-block">
                <span class="top-item top-item-left small"><i class="bx bx-phone-call"></i> <?php echo OFFICE_CONTACT_NO ?></span>
                <span class="top-item top-item-left small"><i class='bx bx-envelope-open'></i> 
                    <?php echo OFFICE_EMAIL ?>
                </span>
            </div>
            <div class="col-md-6 top-right">
                <button type="button" class="btn btn-primary btn-sm px-4 text-white" id="signin-active-link" data-toggle="modal" data-target="#authModel">Login or Register</button>
                <button type="button" class="btn btn-outline-primary btn-sm px-4">My Greeting</button>
            </div>
        </div>
    </div>
</section>
<?php } //else if (!empty(user())) { ?>
<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container p-0">
        <a class="navbar-brand" href="#">
            <img class="logo-nav-image" src="<?php echo asset('frontend/img/logo.png') ?>">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="text-right d-block d-md-none">
                    <a id="close-nav" href="#">Close</a>
                </div>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url('/') ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Celebration
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="celibration">
                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Festivals
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="festival">
                        
                    </div>
                </li>
                <?php if (!empty(user())) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo user()->name; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url('auth/profile'); ?>">Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url('auth/login/logout'); ?>">Log out</a>
                    </div>
                </li>
                <?php }  ?>
            </ul>
        </div>
    </div>
</nav>
<?php //} ?>