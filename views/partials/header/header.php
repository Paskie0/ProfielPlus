<header>
    <a href="<?php $href = empty($_SESSION['user_id']) ? '/' : '/portfolio';
                echo $href ?>">
        <img src="/images/ProfielPlus.svg" alt="Logo">
    </a>
    <nav id="headerNav">
        <ul>
            <?php
            if (empty($_SESSION['user_id'])) {
                $navLinks = [
                    '<li><a href="/login">Login</a></li>',
                    '<li><a href="/signup">Signup</a></li>',
                ];
                echo implode($navLinks);
            } else {
                $navLinks = [
                    '<li><a href="/portfolio">Portfolio</a></li>',
                    '<li><a href="/updateprofile">Account</a></li>',
                    '<li><a href="/logout.php">Logout</a></li>',
                ];
                echo implode($navLinks);
            }
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
        <?php
        if (empty($_SESSION['user_id'])) {
            echo '<li><a href="/login">Login</a></li>';
        } else {
            echo implode($navLinks);
        }
        ?>
    </nav>
</header>