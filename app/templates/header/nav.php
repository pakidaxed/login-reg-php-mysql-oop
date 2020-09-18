<div class="nav-bar">
    <div class="nav-left">
        <div class="nav-logo">
            <?php if (is_logged_in()): ?>
            <a href="secure.php">
                <?php else: ?>
                <a href="index.php">
                    <?php endif; ?>
                    <img src="img/logo.svg"/>
                </a>
        </div>
    </div>

    <div class="menu-right">
        <?php if (is_logged_in()): ?>
            <?= $_SESSION['email']; ?>
            <a class="btn" href="?action=logout">Logout</a>
        <?php else: ?>
            <a class="btn" href="?action=register">Register</a>
            <a class="btn" href="?action=login">Login</a>
        <?php endif; ?>
    </div>
</div>
