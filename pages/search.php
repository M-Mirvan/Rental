<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php";

$q = $_GET['q'] ?? '';

$stmt = $conn->prepare("
    SELECT * FROM cars 
    WHERE name LIKE :q 
       OR type LIKE :q
       
");
$stmt->execute([
    ':q' => "%$q%"
]);

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Link your CSS in the head via header.php ideally -->

<main>
    <div class="container">

        <!-- Search Form -->
<form method="GET" action="/pages/cars.php" class="search-form">
  <div class="search-box">

    <!-- Left search icon -->
    <button type="submit" class="search-icon">
      <img src="assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="<?= htmlspecialchars($car['name']) ?>">
    </button>

    <!-- Input -->
    <input type="search" name="q" class="search-input" placeholder="Search something here" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

    <!-- Right filter icon as a BUTTON (important!) -->
    <button type="button" class="filter-icon" id="filterToggle">
      <img src="assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="<?= htmlspecialchars($car['name']) ?>">
    </button>

    <!-- Filter popup -->
    <div class="filter-popup" id="filterPopup">
      <h4>Type</h4>
      <label><input type="checkbox" name="type[]" value="SUV"> SUV</label>
      <label><input type="checkbox" name="type[]" value="Sport"> Sport</label>
      <label><input type="checkbox" name="type[]" value="Sedan"> Sedan</label>

      <h4>Transmission</h4>
      <label><input type="checkbox" name="transmission[]" value="Automatic"> Automatic</label>
      <label><input type="checkbox" name="transmission[]" value="Manual"> Manual</label>

      <button type="submit" class="button-primary">Apply Filters</button>
    </div>

  </div>
</form>

        <!-- Section Title -->
        <h2 class="section-title">
            Zoekresultaten voor: <?= htmlspecialchars($q) ?>
        </h2>

        <!-- Car Cards -->
        <div class="cars">
            <?php if ($cars): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="car-details">
                        <div class="car-brand">
                            <h3><?= htmlspecialchars($car['name']) ?></h3>
                            <div class="car-type">
                                <?= htmlspecialchars($car['type']) ?>
                            </div>
                        </div>

                        <a class="button-primary"
                           href="/pages/car-detail.php?id=<?= (int)$car['car_id'] ?>">
                            Bekijk nu
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">Geen auto's gevonden 😢</p>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>