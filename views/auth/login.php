<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="../../controllers/authController.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
<?php include '../includes/footer.php'; ?>
