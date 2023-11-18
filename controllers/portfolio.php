<?php
$conn = require 'functions/connection.php';
require 'functions/sqlfunctions.php';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/css/main.css">';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/header/header.css">';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/footer/footer.css">';

session_start();
//maakt een array van alles in de url na "/"
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $urlPath);
//verander "user_id" naar de meegegeven waarde als "user" aanwezig is in de url en anders naar de ingelogde user
if (in_array('user', $parts)) {
    $user_id = end($parts);
} elseif (!empty($_SESSION["user_id"])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('location: /');
}
// meerdere try-catches om data uit de db te halen voor de ingelogde user
// alle data wordt netjes in een variable (...Data) gestopt om makkelijk op te roepen in de html
$userData = sqlGetDataWithParam('firstName, name', 'users', 'id', $user_id, $conn);
$profileData = sqlGetDataWithParam('bio, pfp', 'profile', 'user_id', $user_id, $conn);
$firstName = $userData['firstName'];
$lastName = $userData['name'];

try {
    $sql = "SELECT skills.name AS skill_name, skills_users.skill_level
            FROM skills
            JOIN skills_users ON skills.id = skills_users.skill_id
            WHERE skills_users.user_id = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $user_id);
    $stmt->execute();
    $skillsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}

try {
    $sql = "SELECT education.name AS education_name, education_id
            FROM education
            JOIN education_users ON education.id = education_users.education_id
            WHERE education_users.user_id = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $user_id);
    $stmt->execute();
    $educationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}

try {
    $sql = "SELECT jobs.name AS job_name, job_id
            FROM jobs
            JOIN jobs_users ON jobs.id = jobs_users.job_id
            WHERE jobs_users.user_id = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $user_id);
    $stmt->execute();
    $jobsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}

try {
    $sql = "SELECT project_name, project_img, project_link
            FROM projects
            WHERE projects.user_id = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $user_id);
    $stmt->execute();
    $projectsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}

try {
    $sql = "select job_id from jobs_users where user_id = :param order by started_at desc limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $user_id);
    $stmt->execute();
    $jobIdData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}
//if-statements om defaults te zetten voor de bio, pfp en job_id
if (!empty($profileData['bio'])) {
    $bio = $profileData['bio'];
} else {
    $bio = '';
}

if (!empty($profileData['pfp'])) {
    $pfpData = $profileData['pfp'];
    $binaryData = base64_decode($pfpData);
    $img = imagecreatefromstring($binaryData);
    $fileName = 'userPfp';
    imagejpeg($img, $fileName);

    $pfp = $fileName;
    imagedestroy($img);
} else {
    $pfp = '../images/default_pfp.jpg';
}

if (!empty($jobIdData['job_id'])) {
    $profileJobId = $jobIdData['job_id'];
    $profileJobData = sqlGetDataWithParam('name', 'jobs', 'id', $profileJobId, $conn);
    $jobTitle = $profileJobData['name'];
} else {
    $jobTitle = 'Unemployed';
}

require 'views/portfolio.view.php';
