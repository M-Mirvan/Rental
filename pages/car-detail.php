<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";

//  ID ophalen uit URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<p>Geen auto geselecteerd.</p>";
    require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php";
    exit;
}

//  Auto ophalen 
$stmt = $conn->prepare("SELECT * FROM cars WHERE car_id = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

//   auto niet bestaat
if (!$car) {
    echo "<p>Auto niet gevonden.</p>";
    require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php";
    exit;
}

// 1. Fetch the reviewer count from your database column 'reviewers'
// We use ?? 0 to provide a fallback if the column is empty
$raw_count = $car['reviewers'] ?? 0;

// 2. Calculate stars (Divide by 100, floor to get whole number)
$star_rating = floor($raw_count / 100);

// 3. Set constraints
if ($star_rating > 5) { 
    $star_rating = 5; // Max 5 stars
} 
if ($star_rating < 1 && $raw_count > 0) { 
    $star_rating = 1; // If they have 1-99 reviews, show at least 1 star
}
if ($raw_count <= 0) {
    $star_rating = 0; // Truly 0 reviews = 0 stars
}

?>

<main class="car-detail">
    <div class="grid">

        <div class="row">
            <div class="advertorial">
                <h2><?= htmlspecialchars($car['name']) ?> met het beste design</h2>
                <p>Comfort en prestaties in één voertuig.</p>

                <img src="/assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="<?= htmlspecialchars($car['name']) ?>">
            </div>
        </div>

        <div class="row white-background">

            <h2><?= htmlspecialchars($car['name']) ?></h2>

            <div class="rating">
                <span class="stars stars-<?= (int)$star_rating ?>"></span>
                <span><?= number_format((float)$raw_count) ?>+ reviewers</span>
            </div>

            <p>
                <?= htmlspecialchars($car['name']) ?> is een krachtige 
                <?= htmlspecialchars($car['type']) ?> auto.
            </p>

            <div class="car-type">

                <div class="grid">
                    <div class="row">
                        <span class="accent-color">Type Car</span>
                        <span><?= htmlspecialchars($car['type']) ?></span>
                    </div>

                    <div class="row">
                        <span class="accent-color">Capacity</span>
                        <span><?= (int)$car['capacity'] ?> personen</span>
                    </div>
                </div>

                <div class="grid">
                    <div class="row">
                        <span class="accent-color">Steering</span>
                        <span><?= htmlspecialchars($car['steering']) ?></span>
                    </div>

                    <div class="row">
                        <span class="accent-color">Gasoline</span>
                        <span><?= (int)$car['fuel_capacity'] ?>L</span>
                    </div>
                </div>

                <div class="call-to-action">
                    <div class="row">
                        <span class="font-weight-bold">
                            €<?= number_format($car['price_per_day'], 2, ',', '.') ?>
                        </span> / dag
                    </div>

                    <div class="row">
                        <a href="#" class="button-primary">Huur nu</a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>