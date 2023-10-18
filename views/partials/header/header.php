<header>
    <a href="./index.php">
        <img src="" alt="Logo">
        <h2>ProfielPlus</h2>
    </a>
    <nav>
        <ul>
            <a href="./index.php">Portfolio</a>
            <a href="./register.php">Registreren</a>
            <a href="/login" <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>>Login</a>
            <a href="./account.php">Account</a>
            <svg id="hamburger" viewBox="0 0 100 80" width="40" height="40">
                <rect width="100" height="20" rx="8"></rect>
                <rect y="30" width="100" height="20" rx="8"></rect>
                <rect y="60" width="100" height="20" rx="8"></rect>
            </svg>
        </ul>
    </nav>
</header>
<script src="views/partials/header/header.js"></script>