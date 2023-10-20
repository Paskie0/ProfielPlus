<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/login.css" />
</head>

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
                        <!-- currently password is being hashed in loginAuth.php after the http request. it is probably best to hash it here first
                    using javascript before sending it to the server.-->
                        <input type="password" placeholder="Password" name="password">
                        <input type="submit" value="Submit" id="button">
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