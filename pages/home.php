<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/database/connection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getCars($conn, $limit = 4)
{
    $stmt = $conn->prepare("
        SELECT * 
        FROM cars 
        WHERE available > 0 
        ORDER BY car_id DESC 
        LIMIT :limit
    ");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$popularCars = getCars($conn, 4);
$recommendedCars = getCars($conn, 8);

?>

<header>
    
    <div class="advertorials">
        <div class="advertorial">
            <h2>Hét platform om een auto te huren</h2>
            <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
            <a id="randomCarBtn" href="#" class="button-primary">Huur nu een auto</a>
            <img src="assets/images/car-rent-header-image-1.png" alt="">
        </div>

        <div class="advertorial">
            <h2>Wij verhuren ook bedrijfswagens</h2>
            <p>Voor een vaste lage prijs met prettige voordelen.</p>
            <a href="#" class="button-primary">Huur een bedrijfswagen</a>
            <img src="assets/images/car-rent-header-image-2.png" alt="">
        </div>
    </div>
</header>

<main>



<h2 class="section-title">Populaire auto's</h2>
<div class="cars">

<?php foreach ($popularCars as $car): ?>
    <div class="car-details">
        
        <div class="car-brand">
            <h3><?= htmlspecialchars($car['name']) ?></h3>
            <div class="car-type">
                <?= htmlspecialchars($car['type']) ?>
            </div>
        </div>

        <img src="assets/images/products/car (1).svg" alt="car">

        <div class="car-specification">
            <span>
                <img src="assets/images/icons/gas-station.svg">
                <?= (int)$car['fuel_capacity'] ?>L
            </span>

            <span>
                <img src="assets/images/icons/car.svg">
                <?= htmlspecialchars($car['steering']) ?>
            </span>

            <span>
                <img src="assets/images/icons/profile-2user.svg">
                <?= (int)$car['capacity'] ?> personen
            </span>
        </div>

        <div class="rent-details">
            <span>
                <strong>
                    €<?= number_format((float)$car['price_per_day'], 2, ',', '.') ?>
                </strong> / dag
            </span>

            <!-- FIX: geen / voor bestand -->
            <a href="pages/car-detail.php?id=<?= (int)$car['car_id'] ?>" class="button-primary">
                Bekijk nu
            </a>
        </div>

    </div>
<?php endforeach; ?>

</div>


<h2 class="section-title">Aanbevolen auto's</h2>
<div class="cars">

<?php foreach ($recommendedCars as $car): ?>
    <div class="car-details">

        <div class="car-brand">
            <h3><?= htmlspecialchars($car['name']) ?></h3>
            <div class="car-type">
                <?= htmlspecialchars($car['type']) ?>
            </div>
        </div>

        <img src="assets/images/products/car (1).svg" alt="car">

        <div class="car-specification">
            <span>
                <img src="assets/images/icons/gas-station.svg">
                <?= (int)$car['fuel_capacity'] ?>L
            </span>

            <span>
                <img src="assets/images/icons/car.svg">
                <?= htmlspecialchars($car['steering']) ?>
            </span>

            <span>
                <img src="assets/images/icons/profile-2user.svg">
                <?= (int)$car['capacity'] ?> personen
            </span>
        </div>

        <div class="rent-details">
            <span>
                <strong>
                    €<?= number_format((float)$car['price_per_day'], 2, ',', '.') ?>
                </strong> / dag
            </span>

            <a href="pages/car-detail.php?id=<?= (int)$car['car_id'] ?>" class="button-primary">
                Bekijk nu
            </a>
        </div>

    </div>
<?php endforeach; ?>

</div>

<div class="show-more">
    <a class="button-primary" href="ons-aanbod">Toon alle</a>
</div>

</main>

<?php require "includes/footer.php"; ?>