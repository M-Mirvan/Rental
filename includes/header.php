<?php
session_start();
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php"; ?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rydr</title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
</head>

<body>

<div class="topbar">

    <!-- 🔥 LOGO -->
    <div class="logo">
        <a href="/">Rydr.</a>
    </div>

    <!-- 🔍 SEARCH BAR -->
<form method="GET" action="/pages/cars.php" class="search-form">
    <div class="search-box">
      
            <img src="/assets/images/icons/search-normal.svg" alt="">
        </button>
        
        <input type="search" name="q" class="search-input" placeholder="Search something here">
        
        <a href="#" class="filter-icon">
            <img src="/assets/images/icons/filter.svg" alt="">
        </a>
    </div>
</form>

</form>

    <!-- 📍 NAV -->
    <nav class="nav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/pages/cars.php">Ons aanbod</a></li>
            <li><a href="#">Hulp nodig?</a></li>
        </ul>
    </nav>

    <!-- 👤 ACCOUNT -->
    <div class="menu">

        <?php if (isset($_SESSION['id'])): ?>

            <div class="account">
                <img src="/assets/images/profil.png" alt="profile">

                <div class="account-dropdown">
                    <ul>
                        <li>
                            <img src="/assets/images/icons/setting.svg" alt="">
                            <a href="#">Account</a>
                        </li>

                        <li>
                            <img src="/assets/images/icons/logout.svg" alt="">
                            <a href="/logout">Uitloggen</a>
                        </li>
                    </ul>
                </div>
            </div>

        <?php else: ?>

            <a href="#" class="button-primary">Start met huren</a>

        <?php endif; ?>

    </div>

</div>

<div class="content">