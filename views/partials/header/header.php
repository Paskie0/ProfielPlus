<header>
    <a href="/">
        <img src="/images/ProfielPlus.svg" alt="Logo">
    </a>
    <nav id="headerNav">
        <ul id="test">
        <?php
        $html = !empty($_SESSION["user_id"]) ? '
                        <a href="/portfolio">Portfolio</a>
                        <a href="/updateprofile">Account</a>' :
                        '<a href="/login">Login</a>';
        echo $html;
        ?>
            <button id="menuButton" aria-expanded="false" onclick="openMenu()">
                <svg viewBox="0 0 100 100" fill="#ffffff">
                    <rect width="80" height="10" x="10" y="20" rx="5" class="top"></rect>
                    <rect width="80" height="10" x="10" y="45" rx="5" class="middle"></rect>
                    <rect width="80" height="10" x="10" y="70" rx="5" class="bottom"></rect>
                </svg>
            </button>
        </ul>
    </nav>
    <nav id="headerDropdown">
        <a href="/">Portfolio</a>
        <a href="/login" <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>>Login</a>
        <a href="/account">Account</a>
        <a href="/admin">Admin</a>
    </nav>
</header>