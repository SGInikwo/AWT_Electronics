<?php
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="e-commerce site buy electronics from ATW Electronics">
    <meta name="keywords" content="HTML, CSS, JavaScript, CodeIgniter">
    <meta name="author" content="17001013">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/stylesheet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title><?= $title; ?></title>

</head>
<body>

<!-- Initialising for Facebook like-->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="KX9DnbBt"></script>

<!--Navbar with a lot of Bootstrap-->
<nav class="container-flex navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">AWT Electronics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  me-auto mb-2 mb-lg-0">
                <?php if (session()->isAdmin == true) {?>
                <li class="nav-item">
                    <a class="nav-link" href="/product/add">Add</a>
                </li>
                <?php } ?>
            </ul>
            <form class="d-flex me-auto">
            </form>
            <?php if (session()->loggedIn == false) {?>
            <ul class="navbar-nav">
                <div class="dropdown">
                    <a class="nav-link active dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/user/login">Log In</a></li>
                        <li><a class="dropdown-item" href="/user/register">Register</a></li>
                    </ul>
                </div>
                <?php } ?>
                <li class="nav-item">
                    <a href="/cart"><img src="/assets/images/icon/yellow.png" width="40" height="40"></a>
                </li>
                <?php if (session()->loggedIn == true) { ?>

                    <a class="btn btn-outline-primary ms-3" type="button" href="/user/logout">Log Out</a>
                <?php } ?>
            </ul>

        </div>
    </div>
</nav>