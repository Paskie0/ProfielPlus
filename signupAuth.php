<?php

require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";
//hier wordt de data vanuit opgevraagd en in variablen gestopt.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $con_password = $_POST["con_password"];

    $emaildata = sqlGetDataWithParam('id', 'users', 'email', $email,$conn);
    //hier wordt gecontroleerd of de email beschikbaar is
    if (!empty($emaildata)) {
        echo "<script>alert('Email is already taken')</script>";
        echo "<script>window.location = '/signup'</script>";
    }
//hier wordt gecontrolleerd of alle velden zijn ingevuld.
    if ($email == "" or $first_name == "" or $name == "" or $password == "") {
        echo "<script>alert('Fields cannot be empty')</script>";
        echo "<script>window.location = '/signup'</script>";
    }
//hier wordt gecontrolleerd of het wachtwoord aan de voorwaarde voldoet.
    $validPass = false;
    if (strlen($password) >= 8) {
        $validPass = true;
    } else {
        echo "<script>alert('Password must be at least 8 characters')</script>";
        echo "<script>window.location = '/signup'</script>";
    }
    /** als de gebruiker alle vorige checks heeft voldaan en de ingevulde wachtwoorden zijn hetzeflde dan wordt het acount aangemaakt
     * alle data wordt doormiddel van inserts in de juiste tabellen gezet.*/
    if ($password == $con_password) {
        $sql = "insert into users(name, firstName, email)values (:name, :first_name,:email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $data = sqlGetDataWithParam("id", "users", "email", $email, $conn);
        $id = $data['id'];

        $hashPass = hash('md5', $password);

        $sql = "insert into drowssap(user_id,drowssap)values (:user_id,:drowssap)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':drowssap', $hashPass);
        $stmt->execute();
        //hier is het account aangemaakt en wordt er een sessie aangemaakt zodat de gebruiker direct is ingelogd.
        session_start();
        $_SESSION['user_id'] = $id;
        //hier wordt vast een rij in de profile table aangemaakt. Dit is nodig voor de database structuur.
        sqlInsertIntoValues('profile', 'user_id',$id, $conn);
        //de gebruiker wordt naar de portfolio pagina gestuurd
        header('location: /portfolio');
    }
}

