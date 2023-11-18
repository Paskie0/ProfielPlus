<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/admin.css" />
</head>

<body>
    <?php require 'partials/header/header.php' ?>
    <main>
        <!-- creëert een container voor elke user met een delete knop -->
        <?php foreach ($userData as $user) {
            echo "<div class='userCard'>";
            echo "<span>" . $user['firstName'] . " " . $user['name'] . " </span>";
            echo "<span>" . "id: " . $user['id'] . " </span>";
            echo "<form method='post' action='deleteUser.php'>";
            echo "<input type='hidden' name='userId' value='" . $user['id'] . "'>";
            echo "<button type='submit' name='deleteButton'>";
            echo "<img src='../images/delete.svg' alt='Delete'>";
            echo "</button>";
            echo "</form>";
            echo "</div>";
        } ?>
    </main>
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>