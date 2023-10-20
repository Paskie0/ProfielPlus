<header>
    <a href="/">
        <img src="/images/PROFIEL%20PLUS%20inverted.png" alt="Logo">
        <h2>ProfielPlus</h2>
    </a>
    <nav>
        <ul>
            <a href="/">Portfolio</a>
            <a href="/login" <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>>Login</a>
            <a href="/account">Account</a>
            <a href="/admin">Admin</a>
            <svg id="hamburger" viewBox="0 0 100 80" width="40" height="40">
                <rect width="100" height="20" rx="8"></rect>
                <rect y="30" width="100" height="20" rx="8"></rect>
                <rect y="60" width="100" height="20" rx="8"></rect>
            </svg>
        </ul>
    </nav>
</header>