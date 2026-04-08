<?php require "includes/header.php"; ?>

<main>
    <h2>Ons aanbod</h2>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Database connection
    try {
        $conn = new PDO(
            "mysql:host=localhost;dbname=rental;charset=utf8mb4",
            "root",
            ""
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

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


    <div class="cars">
        <?php foreach ($popularCars as $car): ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($car['name']) ?></h3>
                    <div class="car-type"><?= htmlspecialchars($car['type']) ?></div>
                </div>

                <img src="assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="<?= htmlspecialchars($car['name']) ?>">

                <div class="car-specification">
                    <span>
                        <img src="assets/images/icons/gas-station.svg" alt="Fuel Capacity">
                        <?= (int)$car['fuel_capacity'] ?>L
                    </span>

                    <span>
                        <img src="assets/images/icons/car.svg" alt="Steering">
                        <?= htmlspecialchars($car['steering']) ?>
                    </span>

                    <span>
                        <img src="assets/images/icons/profile-2user.svg" alt="Capacity">
                        <?= (int)$car['capacity'] ?> personen
                    </span>
                </div>

                <div class="rent-details">
                    <span>
                        <strong>€<?= number_format((float)$car['price_per_day'], 2, ',', '.') ?></strong> / dag
                    </span>

                    <a href="pages/car-detail.php?id=<?= (int)$car['car_id'] ?>" class="button-primary">
                        Bekijk nu
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="cars">
        <?php foreach ($recommendedCars as $car): ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($car['name']) ?></h3>
                    <div class="car-type"><?= htmlspecialchars($car['type']) ?></div>
                </div>

                <img src="assets/images/products/car (<?= (int)$car['car_id'] ?>).svg" alt="<?= htmlspecialchars($car['name']) ?>">

                <div class="car-specification">
                    <span>
                        <img src="assets/images/icons/gas-station.svg" alt="Fuel Capacity">
                        <?= (int)$car['fuel_capacity'] ?>L
                    </span>

                    <span>
                        <img src="assets/images/icons/car.svg" alt="Steering">
                        <?= htmlspecialchars($car['steering']) ?>
                    </span>

                    <span>
                        <img src="assets/images/icons/profile-2user.svg" alt="Capacity">
                        <?= (int)$car['capacity'] ?> personen
                    </span>
                </div>

                <div class="rent-details">
                    <span>
                        <strong>€<?= number_format((float)$car['price_per_day'], 2, ',', '.') ?></strong> / dag
                    </span>

                    <a href="pages/car-detail.php?id=<?= (int)$car['car_id'] ?>" class="button-primary">
                        Bekijk nu
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require "includes/footer.php"; ?>