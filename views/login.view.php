<html lang="en">

<?php require 'partials/head.php' ?>
<link rel="stylesheet" href="../views/partials/css/login.css"/>
</head>
<body>
<?php require 'partials/header/header.php' ?>
<main>
    <div>
        left
    </div>
    <section>
        <ul>
            <li><img src="../images/PROFIEL%20PLUS%20inverted.png" alt="Logo"></li>
            <li>
                <form method="post" action="../loginAuth.php">
                    <input type="text" placeholder="Email" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <input type="submit" value="Submit">
                </form>
            </li>
            <li>
                <ul>
                    <li>signup</li>
                    <li>forgotten password</li>
                </ul>
            </li>
        </ul>
    </section>
</main>
<?php require 'partials/footer/footer.php' ?>
</body>

</html>