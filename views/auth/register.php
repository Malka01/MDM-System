<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Register</h2>
    <form method="POST" action="../../controllers/authController.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
<?php include '../includes/footer.php'; ?>
