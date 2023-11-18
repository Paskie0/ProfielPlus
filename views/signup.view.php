<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/signup.css" />
</head>

</head>

<body>
    <?php require 'partials/header/header.php' ?>
    <main>
        <div>

        </div>
        <section>
            <img src="../images/ProfielPlus.svg" alt="Logo">
            <!--Wireframe - In feite hetzelfde als login.php, simpel en right-aligned -->
            <form method="post" action="../signupAuth.php">
                <input type="text" placeholder="Email" name="email">
                <input type="text" placeholder="First name" name="first_name">
                <input type="text" placeholder="Last name" name="name">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Confirm password" name="con_password">
                <input type="submit" value="Submit" id="button">
            </form>
        </section>
    </main>
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>