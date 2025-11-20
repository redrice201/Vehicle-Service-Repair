<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <a href="index.html" class="navbar-brand">CarCare</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-nav-first">
                <li><a href="index.php" class="smoothScroll">Home</a></li>
                <li><a href="#about" class="smoothScroll">About</a></li>
                <li><a href="#service" class="smoothScroll">Service</a></li>

                <?php if (!isset($_SESSION["user"])): ?>
                    <li><a href="#" class="openLoginModal smoothScroll">Book Service</a></li>
                <?php else: ?>
                    <li><a href="bookservice.php" class="smoothScroll">Book Service</a></li>
                <?php endif; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                <?php if (!isset($_SESSION["user"])): ?>
                    <li class="section-btn"><a href="#" class="openLoginModal">Login</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?= $_SESSION["user"]["name"]; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="servicetracking.php">My Car Status</a></li>
                            <li><a href="userinformation.php">Change Information</a></li>
                            <li><a href="loginuser/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>

<div id="messageBox"></div>
<script></script>
<?php include 'service/modalservice.php'?>
<?php include 'login.php'?>
<?php include 'forgotpassword/changepassword.php'?>
<?php include 'forgotpassword/verificationmodal.php'?>
<?php include 'register.php'?>
<?php include 'forgot_password.php'?>
<?php include 'verification/verification_moda.php'?>
