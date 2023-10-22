<?php
session_start();

require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";

if (isset($_POST['profileSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pfp = $_POST["pfp"];
        $bio = $_POST["bio"];
    }
}

if (isset($_POST['projectsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $project_image = $_POST["project_image"];
        $project_link = $_POST["project_link"];
    }
}

if (isset($_POST['jobsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jobtitle = $_POST["jobtitle"];
        $companyName = $_POST["companyName"];
        $job_started_at = $_POST["job_started_at"];
        $job_stopped_at = $_POST["job_stopped_at"];

        $job_stopped_at = strtotime($job_started_at);
        $job_stopped_at = strtotime($job_stopped_at);

    }
}

if (isset($_POST['educationSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $education_name = $_POST["education_name"];
        $school_name = $_POST["school_name"];
        $edu_started_at = $_POST["edu_started_at"];
        $edu_finished_at = $_POST["edu_finished_at"];

        $edu_started_at = strtotime($edu_started_at);
        $edu_finished_at = strtotime($edu_finished_at);
    }
}

if (isset($_POST['skillsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $skill_name = $_POST["skill_name"];
        $skill_level = $_POST["skill_level"];

        $data_skill_name = sqlGetDataWithParam('name', 'skills', 'name', $skill_name, $conn);
        if (empty($data_skill_name)) {
            sqlInsertIntoValues('skills', 'name', $skill_name, $conn);
        }
        $skill_idData = sqlGetDataWithParam('id', 'skills', 'name', $skill_name, $conn);
        $skill_id = $skill_idData['id'];
        sqlInsertIntoValues('skills_users', 'user_id,skill_id,skill_level', $_SESSION["user_id"] . ',' . $skill_id . ',' . $skill_level, $conn);
        header('location: /updateprofile');
    }
}
