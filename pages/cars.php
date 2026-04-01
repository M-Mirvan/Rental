<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php";

/* ============================================================
    1. DATA OPHALEN & COUNTERS BEREKENEN
   ============================================================ */
$allCarsStmt = $conn->query("SELECT type, capacity FROM cars");
$allCarsData = $allCarsStmt->fetchAll(PDO::FETCH_ASSOC);

$typeTotals = [];
$capTotals = [
    '2 Person' => 0,
    '4 Person' => 0,
    '6 Person' => 0,
    '8 or More' => 0
];

foreach ($allCarsData as $row) {
    $t = $row['type'];
    $typeTotals[$t] = ($typeTotals[$t] ?? 0) + 1;

    $c = (int)$row['capacity'];
    if ($c >= 8) $capTotals['8 or More']++;
    elseif ($c == 6) $capTotals['6 Person']++;
    elseif ($c == 4) $capTotals['4 Person']++;
    elseif ($c == 2) $capTotals['2 Person']++;
}

/* ============================================================
    2. HOOFDQUERY MET FILTERS
   ============================================================ */
$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

// --- 📍 SEARCH FIX: Handle the 'q' parameter from the header ---
if (!empty($_GET['q'])) {
    $searchTerm = trim($_GET['q']);
    $sql .= " AND name LIKE ?";
    $params[] = "%$searchTerm%"; 
}

// Filter op Type
if (!empty($_GET['type'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['type']), '?'));
    $sql .= " AND type IN ($placeholders)";
    $params = array_merge($params, $_GET['type']);
}

// Filter op Capacity 
if (!empty($_GET['capacity'])) {
    $capFilters = $_GET['capacity'];
    $sql .= " AND (";
    $capQueries = [];
    
    foreach ($capFilters as $val) {
        $val = (int)$val;
        if ($val == 8) {
            $capQueries[] = "capacity >= 8"; 
        } else {
            $capQueries[] = "capacity = $val"; 
        }
    }
    $sql .= implode(" OR ", $capQueries) . ")";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/search-page.css">
<div class="app-container">
    <aside class="app-sidebar">
        <form method="GET" id="filterForm" action="">
            <?php if (!empty($_GET['q'])): ?>
                <input type="hidden" name="q" value="<?= htmlspecialchars($_GET['q']) ?>">
            <?php endif; ?>

            <div class="filter-group">
                <span class="filter-label">Type</span>
                <?php foreach(['Sport', 'SUV', 'MPV', 'Sedan'] as $t): ?>
                <label class="custom-checkbox">
                    <span>
                        <input type="checkbox" name="type[]" value="<?= $t ?>" 
                        <?= (isset($_GET['type']) && in_array($t, $_GET['type'])) ? 'checked' : '' ?>
                        onchange="document.getElementById('filterForm').submit()"> 
                        <?= $t ?>
                    </span>
                    <span class="count-tag">(<?= $typeTotals[$t] ?? 0 ?>)</span>
                </label>
                <?php endforeach; ?>
            </div>

            <div class="filter-group">
                <span class="filter-label">Capacity</span>
                <?php 
                $caps = [2 => '2 Person', 4 => '4 Person', 6 => '6 Person', 8 => '8 or More'];
                foreach($caps as $val => $label): ?>
                <label class="custom-checkbox">
                    <span>
                        <input type="checkbox" name="capacity[]" value="<?= $val ?>"
                        <?= (isset($_GET['capacity']) && in_array((string)$val, $_GET['capacity'] ?? [])) ? 'checked' : '' ?>
                        onchange="document.getElementById('filterForm').submit()"> 
                        <?= $label ?>
                    </span>
                    <span class="count-tag">(<?= $capTotals[$label] ?? 0 ?>)</span>
                </label>
                <?php endforeach; ?>
            </div>
        </form>
    </aside>

    <main class="car-main">
        <div class="car-display-grid">
            <?php if (count($cars) > 0): ?>
                <?php foreach ($cars as $car): ?>
                <div class="car-item">
                    <div class="car-info">
                        <h3><?= htmlspecialchars($car['name']) ?></h3>
                        <span><?= htmlspecialchars($car['type']) ?></span>
                    </div>
                    
                    <div class="car-img-wrapper">
                        <img src="/assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="Car">
                    </div>

                    <div class="car-footer">
                        <div class="price-tag">
                            €<?= number_format($car['price_per_day'], 2) ?>/ <small>day</small>
                        </div>
                        <a href="/pages/car-detail.php?id=<?= $car['car_id'] ?>" class="btn-action">Bekijk nu</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No cars found for "<strong><?= htmlspecialchars($_GET['q'] ?? '') ?></strong>".</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>