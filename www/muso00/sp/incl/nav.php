<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container px-4 px-lg-5">
            <div class="logo"><img src="./assets/logo.png" alt="logo" width="50"></div>
            <a class="navbar-brand" href="./index.php">Liquor Town</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./products.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                </ul>
                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <div class="d-flex btn">
                        <a href="./signin.php" class="btn btn-acc">
                            <i class="bi bi-person-fill"></i> Account</a>
                    </div>
                <?php else : ?>
                    <div class="d-flex nav-item dropdown">
                        <a class="btn text-black nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-check-fill"></i> <span><?php echo $_SESSION['user_first_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./profile.php">My account</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="./utils/logout.php">Sign out</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="d-flex">
                    <a href="./cart.php" class="btn btn-cart btn-outline-dark"><i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <?php if (isset($_SESSION['shopping_cart'])) {
                                echo array_sum(array_column($_SESSION['shopping_cart'], 'item_qty'));
                            } ?>
                        </span></a>
                </div>
            </div>
        </div>
    </nav>