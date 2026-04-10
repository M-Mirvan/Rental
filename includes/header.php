<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php"; 
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Huur de beste auto's bij Rydr. Ontdek ons ruime aanbod aan SUV's, sportwagens en sedans voor de scherpste prijzen. Makkelijk en snel online boeken.">
    <title>Rydr</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/search.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <script src="assets/javascript/main.js" defer></script>
</head>

<body>

<div class="topbar">
    <div class="logo">
        <a href="/">Rydr.</a>
    </div>

    <form class="search-form" method="GET" action="/pages/cars.php">
        <div class="search-box">
            <div class="search-icon">
                <img src="/assets/images/icons/search-normal.svg" alt="Search">
            </div>
            <input type="search" name="q" class="search-input" placeholder="Search something here">
            <button type="button" class="filter-icon" id="filterToggle">
                <img src="/assets/images/icons/filter.svg" alt="Filter">
            </button>
        </div>
    </form>

    <nav class="nav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/pages/cars.php?q=">Ons aanbod</a></li>
            <li><a href="#">Hulp nodig?</a></li>
        </ul>
    </nav>

    <div class="menu">
        <?php if (isset($_SESSION['id'])): ?>
            <div class="account">
                <img src="/assets/images/profil.png" alt="profile">
                <div class="account-dropdown">
                    <ul>
                        <li>
                            <img src="/assets/images/icons/setting.svg" alt="sett">
                            <a href="#">Account</a>
                        </li>
                        <li>
                            <img src="/assets/images/icons/logout.svg" alt="logout">
                            <a href="/logout">Uitloggen</a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <a href="/login.php" class="button-primary">Start met huren</a>
        <?php endif; ?>
    </div>
</div>

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

<div class="content">
    </div>

</body> 

</html>