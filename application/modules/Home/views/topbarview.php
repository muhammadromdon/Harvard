<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?php echo base_url() ?>assets/css/image/Logo.png" alt="Harvard" style="width: 40px;">
            Harvard University
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMain" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="<?php echo base_url('Home') ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo base_url('Home/Students') ?>">Students</a>
                <?php if (!$this->session->userdata('email')) : ?>
                    <a class="nav-item nav-link" href="<?php echo base_url('Auth') ?>">Login</a>
                <?php else : ?>
                    <a class="nav-item nav-link" href="<?php echo base_url('Auth/Logout') ?>">Logout</a>
                <?php endif ?>
                <?php if (!$this->session->userdata('email')) : ?>
                    <a class="nav-item btn btn-primary tombol" href="<?php echo base_url('Auth/Registration') ?>">Join Us</a>
                <?php else : ?>
                    <a class="nav-item btn btn-primary tombol" href="<?php echo base_url('Users') ?>">Dashboard</a>
                <?php endif ?>

            </div>
        </div>
    </div>
</nav>

<!-- End Navbar -->

<!-- Jumbotron -->

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4"><span>Best</span> Place To<span> Learn All Knowledge</span><br> Never <span>Stop</span> Never <span>Tired</span></h1>
        <a href="" class="btn-sm btn-primary tombol">About Us</a>
    </div>
</div>

<!-- End Jumbotron -->

<!-- Container -->

<div class="container">

    <!-- Info Panel -->

    <div class="row justify-content-center">
        <div class="col-10 info-panel">
            <div class="row">
                <div class="col-lg">
                    <img src="<?php echo base_url() ?>assets/css/image/Logo.png" alt=" Login" class="float-left">
                    <a href="<?php echo base_url('Home') ?>" class="btn">
                        <h4>Veritas</h4>
                    </a>
                    <p>Our mission check out here!</p>
                </div>
                <div class="col-lg">
                    <img src="<?php echo base_url() ?>assets/css/image/Regist.png" alt="Register" class=" float-left">
                    <a href="<?php echo base_url('Auth/Registration') ?>" class="btn">
                        <h4>Register</h4>
                    </a>
                    <p>Register your data here fellas!</p>
                </div>
                <div class="col-lg">
                    <img src="<?php echo base_url() ?>assets/css/image/Mascot.png" alt="Info" class="float-left">
                    <a href="<?php echo base_url('Home') ?>" class="btn">
                        <h4>Info</h4>
                    </a>
                    <p>Our site info, check out here!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- End Panel -->