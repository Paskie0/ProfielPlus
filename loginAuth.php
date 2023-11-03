<?php
require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";
/** in de login maken wij gebruik van de $_POST superglobal. hier hebben wij voor gekozen vanwege de veiligheid. met $_GET wordt de data over de url gestuurd
 *en dat is bij een login niet veilig.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //hier wordt de data vanuit de post opgevraagdt en in een variable gestopt.
    $email = $_POST["email"];
    $password = $_POST["password"];
    //hier wordt gecontrolleerd of alle velden wel zijn ingevuld.
    if ($email == "" or $password == "") {
        $notNull = false;
    } else {
        $notNull = true;
    }
    //hier wordt het wachtwoord gehashed zodat wanneer er een eventuele databreuk is zijn de wachtwoorden encrypted.
    $password = hash('md5', $password);
}
/** hier gebeurt het grootste gedeelte van de login logica. als eerst wordt de user_id opgezocht die matched met de email
 * daarna wordt er gecontrolleerd of er wel een user_id is. als dit niet het geval is dan betekend het dat de email niet correct is. hier wordt de gebruiken
 * van op de hoogte gestelt doormiddel van een alert.  daarna wordt het wachtwoord van de user_id opgevraagd . de wachtwoorden worden gehashed
 * opgeslagen dus beide gehashde wachtwoorden worden met elkaar vergeleken en als het een match is wordt er een sessie gestart waar de user_id wordt opgeslagen
 * en de gebruiker wordt naar de portfolio pagina gestuurd.*/
if ($notNull) {
    $idData = sqlGetDataWithParam('id', 'users', "email", $email, $conn);

    if ($idData !== false) {
        $id = $idData['id'];
        $drowssapData = sqlGetDataWithParam('drowssap', 'drowssap', "user_id", $id, $conn);
        $drowssap = $drowssapData['drowssap'];
        if ($password == $drowssap) {
            session_start();
            $_SESSION['user_id'] = $id;

            header('location: /portfolio');
        } else {
            echo "<script>alert('Incorrect password')</script>";
            echo "<script>window.location = '/login'</script>";
        }
    } else {
        echo "<script>alert('Incorrect email')</script>";
        echo "<script>window.location = '/login'</script>";
    }
} else {
    echo "<script>alert('Email or password cannot be empty')</script>";
    echo "<script>window.location = '/login'</script>";
}
