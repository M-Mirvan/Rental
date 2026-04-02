<?php 
// Start session only if not already started to save resources
if (session_status() === PHP_SESSION_NONE) session_start(); 
require "includes/header.php"; 
?>

<link rel="preload" href="/assets/css/search.css" as="style">
<link rel="stylesheet" href="/assets/css/search.css">

<main>
    <form action="/login-handler" class="account-form" method="post">
        <h2>Log in</h2>

        <?php 
        // Optimized: Handle session messages in one block to reduce PHP processing time
        if (isset($_SESSION['success'])): ?>
            <div class="succes-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message" style="color: #ff4d4d; margin-bottom: 10px;">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <label for="email">Uw e-mail</label>
        <input type="email" name="email" id="email" autocomplete="email" placeholder="johndoe@gmail.com" 
               value="<?= $_SESSION['email'] ?? '' ?>" required autofocus>
        
        <label for="password">Uw wachtwoord</label>
        <input type="password" name="password" id="password" autocomplete="current-password" placeholder="Uw wachtwoord" required>
        
        <input type="submit" value="Log in" class="button-primary">
    </form>
</main>

<?php require "includes/footer.php"; ?>