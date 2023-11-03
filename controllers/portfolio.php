<?php
require 'functions/sqlfunctions.php';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/css/main.css">';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/header/header.css">';
echo '<link rel="stylesheet" type="text/css" href="../views/partials/footer/footer.css">';

session_start();

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $urlPath);

//if /user/ is in the url, get the user id from the url, otherwise get the user id from the session
if (in_array('user', $parts)) {
    $user_id = end($parts);
} else {
    $user_id = $_SESSION['user_id'];
}

$userData = sqlGetDataWithParam('firstName, name', 'users', 'id', $user_id, $conn);
$profileData = sqlGetDataWithParam('bio, pfp', 'profile', 'user_id', $user_id, $conn);
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
    $sql = "SELECT education.name AS education_name
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
    $sql = "SELECT jobs.name AS job_name
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

$firstName = $userData['firstName'];
$lastName = $userData['name'];
$bio = $profileData['bio'];

require 'views/portfolio.view.php';
