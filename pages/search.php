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

<main>

<div class="container">

    <h2 class="section-title">
        Zoekresultaten voor: <?= htmlspecialchars($q) ?>
    </h2>

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