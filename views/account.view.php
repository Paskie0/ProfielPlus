<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/account.css" />
</head>

<body>
    <?php require 'partials/header/header.php' ?>
    <main>
        <section>
            <h2>Account</h2>
            <ul>
               <li><img src="../images/PROFIEL%20PLUS%20inverted.png" alt="Logo"></li>
                <li>
                    <form action="/" method="post">
                        <input  type="hidden" value="<?= $hobby[0]['id']; ?>">
                        <input type="text" value="<?= $hobby[0]['hobby']; ?>">
                        <button type="submit">Bewerk</button>
                    </form>
                </li>
            </ul>
        </section>
    </main>
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>