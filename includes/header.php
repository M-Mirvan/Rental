<?php
session_start();
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php"; ?>
<!doctype html>
<html lang="nl">
<head>
    <script src="/assets/javascipt.main.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rydr</title>
    <link rel="stylesheet" href="/assets/css/search.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="/assets/css/search.css">
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
<form class="search-form" method="GET" action="/pages/cars.php">
  <div class="search-box">
    <!-- Left search icon (decorative only) -->
    <div class="search-icon">
      <img src="/assets/images/icons/search-normal.svg" alt="Search">
    </div>

    <!-- Input -->
    <input type="search" name="q" class="search-input" placeholder="Search something here">

    <!-- Right filter icon (opens popup) -->
    <button type="button" class="filter-icon" id="filterToggle">
      <img src="/assets/images/icons/filter.svg" alt="Filter">
    </button>
  </div>
</form>

<!-- Filter modal -->
<div class="filter-modal" id="filterModal">
  <div class="filter-modal-content">
    <span class="modal-close" id="filterClose">&times;</span>
    <h2>Filter your search</h2>

    <form method="GET" action="/pages/cars.php">
      <h4>Type</h4>
      <label><input type="checkbox" name="type[]" value="SUV"> SUV</label>
      <label><input type="checkbox" name="type[]" value="Sport"> Sport</label>
      <label><input type="checkbox" name="type[]" value="Sedan"> Sedan</label>

      <h4>Transmission</h4>
      <label><input type="checkbox" name="transmission[]" value="Automatic"> Automatic</label>
      <label><input type="checkbox" name="transmission[]" value="Manual"> Manual</label>

      <button type="submit" class="button-primary">Apply Filters</button>
    </form>
  </div>
</div>

    <!-- 📍 NAV -->
    <nav class="nav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/ons-aanbod">Ons aanbod</a></li>
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
</body>

<div class="content">
