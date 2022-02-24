<?php
    session_start();
    error_reporting(0);
    require 'configuration.php';
    // if(empty($_SESSION['cart'])){
    //     $_SESSION['cart'] = [];
    // }
    $session = $_SESSION['loggedin'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Phillip's Cheese</title>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <?php
    
        if(isset($_SESSION['loggedin'])){
            $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
            $values = [
                'user_id' => $_SESSION['loggedin']
            ];
            $stmt->execute($values);
            $data = $stmt->fetch();
        }
        $items=$pdo->prepare('SELECT * FROM products JOIN carts ON products.product_id = carts.product_id WHERE user_id = :user_id');
        $values=[
            'user_id' => $_SESSION['loggedin']
        ];
        $items->execute($values);
    ?>
    <body>
    
        <div class="nav">
            <?php
                if($_SESSION['loggedin']==$data['user_id'] && $data['user_access']=='1'){
            ?>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="reviews.php" class="nav-item nav-link">Reviews</a>
                            <a href="products.php" class="nav-item nav-link">Products</a>
                            <a href="my-account.php" class="nav-item nav-link">Admin page</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu">
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <?php } else if ($_SESSION['loggedin']==$data['user_id'] && $data['user_access']=='0') { ?>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="products.php" class="nav-item nav-link">Products</a>
                            <a href="reviews.php" class="nav-item nav-link">Reviews</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                                <div class="dropdown-menu">
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <?php } else { ?>
                <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="products.php" class="nav-item nav-link">Products</a>
                            <a href="reviews.php" class="nav-item nav-link">Reviews</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                                <div class="dropdown-menu">
                                    <a href="login.php" class="dropdown-item">Login</a>
                                    <a href="register.php" class="dropdown-item">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <?php } ?>
        </div>
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3 ">
                        <div class="logo text-center">
                            <a href="index.php">
                                <img src="img/phillipscheese_logo5.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <input type="text" placeholder="Search">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="cart.php" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>