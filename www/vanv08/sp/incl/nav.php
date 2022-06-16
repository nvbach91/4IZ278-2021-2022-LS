<?php
?>
<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>

            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <?php
                if(empty($_SESSION['user_id'])) : ?>
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="register.php" class="nav-item nav-link">Register</a>
                <a href="login.php" class="nav-item nav-link">Login</a>
                <?php endif ?>
                <?php
                if(!empty($_SESSION['user_id']) AND $_SESSION['user_level'] == 1) : ?>
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="product_form.php" class="nav-item  nav-link">Sell</a>
                <a href="user_orders.php" class="nav-item  nav-link">My orders</a>
                <a href="user_offers.php" class="nav-item  nav-link">My offers</a>
                <a href="./utils/logout.php" class="nav-item nav-link">Log out</a>
                <? endif ?>
                <? if(!empty($_SESSION['user_id']) AND $_SESSION['user_level'] == 2) : ?>
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="product_form.php" class="nav-item  nav-link">Sell</a>
                <a href="user_orders.php" class="nav-item  nav-link">Active orders</a>
                <a href="user_offers.php" class="nav-item  nav-link">Active offers</a>
                <a href="./utils/logout.php" class="nav-item nav-link">Log out</a>
                <?endif ?>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="index.php" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-black font-weight-bold border px-3 mr-1">R</span>ailed</h1>
            </a>
        </div>

    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-black font-weight-bold border px-3 mr-1">R</span>ailed</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </nav>
        </div>
    </div>
</div>

<!-- Navbar End -->