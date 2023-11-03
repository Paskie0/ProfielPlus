<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/login.css" />
</head>

<body>
    <?php require 'partials/header/header.php' ?>
    <main>
        <div>

        </div>
        <section>
            <!--            de login en signup hebben we erg subtiel gehouden. het is een functie die een gebruiken niet vaak zal gebruiken dus is het overbodig in veel flare toe te voegen
daarom is de login niet groter dan hij moet zijn en hebben we hem aan de rechter kant geplaats.-->
            <ul>
                <li><img src="../images/ProfielPlus.svg" alt="Logo"></li>
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
                        <li><a href="/signup">signup</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </main>
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>