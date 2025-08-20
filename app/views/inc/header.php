<?php $name = $_SESSION['session_loginuser']; ?>
<?php
$currentUrl = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="/librarycss/index.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/category.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/literarybook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/historicalbook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/educationbook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/romancebook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/horrorbook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/cartoonbook.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/librarycss/contact.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" xintegrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/main.css"> -->

    <!-- Sweet Alert For Delete -->
    <!-- <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" /> -->
    <!-- Form Validation -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/form_validate.css">


</head>

<body>
   
    <!-- <header class="header"> -->
    <div class="header-content">
        <nav>
<a href="<?php echo URLROOT; ?>/index" class="navbar-brand">
            <i class="fas fa-book-reader"></i> Go Library
        </a>
            <ul class="nav">
                <li><a href="<?php echo URLROOT; ?>/pages/category">Home</a></li>
                <!-- <li><a href="<?php echo URLROOT; ?>/pages/contact">Contact</a></li> -->
                <li><a href="<?php echo URLROOT; ?>/user/history">History</a></li>
                <li><a href="<?php echo URLROOT; ?>/auth/logout">Logout</a></li>
                <li>
                    <a href="<?php echo URLROOT; ?>/user/userProfile"
                        class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition duration-300">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span class="font-medium">
                            <?= htmlspecialchars($name['name']) ?>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- </header>  -->