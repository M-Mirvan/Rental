<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php";

/* =========================
   FILTERS
========================= */
$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

/* SEARCH */
if (!empty($_GET['q'])) {
    $sql .= " AND name LIKE ?";
    $params[] = "%" . $_GET['q'] . "%";
}

/* TYPE */
if (!empty($_GET['type'])) {
    $sql .= " AND type IN (" . str_repeat('?,', count($_GET['type']) - 1) . "?)";
    $params = array_merge($params, $_GET['type']);
}

/* STEERING */
if (!empty($_GET['steering'])) {
    $sql .= " AND steering IN (" . str_repeat('?,', count($_GET['steering']) - 1) . "?)";
    $params = array_merge($params, $_GET['steering']);
}

/* CAPACITY */
if (!empty($_GET['capacity'])) {
    $sql .= " AND capacity IN (" . str_repeat('?,', count($_GET['capacity']) - 1) . "?)";
    $params = array_merge($params, $_GET['capacity']);
}

/* EXECUTE */
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="layout">

    <!-- 🔥 SIDEBAR FILTER -->
    <aside class="sidebar">

        <form method="GET" action="/pages/cars.php">

            <h3>Search</h3>
            <input type="text" name="q" placeholder="Search car...">

            <h3>Type</h3>
            <label><input type="checkbox" name="type[]" value="SUV"> SUV</label>
            <label><input type="checkbox" name="type[]" value="Sport"> Sport</label>
            <label><input type="checkbox" name="type[]" value="Sedan"> Sedan</label>

            <h3>Transmission</h3>
            <label><input type="checkbox" name="steering[]" value="Automatic"> Automatic</label>
            <label><input type="checkbox" name="steering[]" value="Manual"> Manual</label>

            <h3>Seats</h3>
            <label><input type="checkbox" name="capacity[]" value="2"> 2</label>
            <label><input type="checkbox" name="capacity[]" value="5"> 5</label>
            <label><input type="checkbox" name="capacity[]" value="7"> 7</label>

            <button type="submit">Apply filters</button>

        </form>

    </aside>

    <!-- 🚗 CAR GRID -->
    <main class="cars-grid">

        <?php foreach ($cars as $car): ?>
            <div class="car-card">

                <h3><?= htmlspecialchars($car['name']) ?></h3>
                <p><?= htmlspecialchars($car['type']) ?></p>

                <p>€<?= number_format($car['price_per_day'], 2) ?> / day</p>

                <a href="/pages/car-detail.php?id=<?= $car['car_id'] ?>">
                    Bekijk
                </a>

            </div>
        <?php endforeach; ?>

    </main>

</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>