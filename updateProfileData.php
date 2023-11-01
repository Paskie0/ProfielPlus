<?php
session_start();

require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";
$user_id = $_SESSION["user_id"];

if (isset($_POST['profileSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pfp = $_POST["pfp"];
        $bio = $_POST["bio"];

        sqlUpdateTwo('profile', 'pfp', $pfp, 'bio', $bio, 'user_id', $user_id, $conn);
        header('location: /updateprofile');
    }
}

if (isset($_POST['projectsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $project_name = $_POST["project_name"];
        $project_image = $_POST["project_image"];
        $project_link = $_POST["project_link"];

        if (!empty($project_link) and !empty($project_image) and !empty($project_name)){
            sqlInsertIntoValues('projects', 'user_id,project_name,project_link,project_img', $user_id . ','. $project_name. ',' . $project_link .','. $project_image,$conn);
            header('location: /updateprofile');
        }else{
            header('location: /updateprofile');
        }
    }
}

if (isset($_POST['jobsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jobtitle = $_POST["jobtitle"];
        $companyName = $_POST["companyName"];
        $job_started_at = $_POST["job_started_at"];
        $job_stopped_at = $_POST["job_stopped_at"];


        if (!empty($jobtitle) and !empty($companyName) and !empty($job_started_at)) {
            $job_stopped_at = strtotime($job_started_at);
            $job_stopped_at = strtotime($job_stopped_at);

            $companyData = sqlGetDataWithParam('name', 'companies', 'name', $companyName, $conn);
            if (empty($companyData)) {
                sqlInsertIntoValues('companies', 'name', $companyName, $conn);
            }
            $jobData = sqlGetDataWithParam('name', 'jobs', 'name', $jobtitle, $conn);
            if (empty($jobData)) {
                sqlInsertIntoValues('jobs', 'name', $jobtitle, $conn);
            }

            $companyIdData = sqlGetDataWithParam('id', 'companies', 'name', $companyName, $conn);
            $companyId = $companyIdData['id'];
            $jobIdData = sqlGetDataWithParam('id', 'jobs', 'name', $jobtitle, $conn);
            $jobId = $jobIdData['id'];

            sqlInsertIntoValues('jobs_users', 'user_id,job_id,company_id,started_at,stopped_at',
                $user_id . ',' . $jobId . ',' . $companyId . ',' . $job_started_at . ',' . $job_stopped_at, $conn);
            header('location: /updateprofile');
        } else {
            header('location: /updateprofile');
        }
    }
}

if (isset($_POST['educationSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $education_name = $_POST["education_name"];
        $school_name = $_POST["school_name"];
        $edu_started_at = $_POST["edu_started_at"];
        $edu_finished_at = $_POST["edu_finished_at"];

        if (!empty($education_name) and !empty($school_name) and !empty($edu_started_at)) {
            $edu_started_at = strtotime($edu_started_at);
            $edu_finished_at = strtotime($edu_finished_at);

            $schoolData = sqlGetDataWithParam('name', 'schools', 'name', $school_name, $conn);
            if (empty($schoolData)) {
                sqlInsertIntoValues('schools', 'name', $school_name, $conn);
            }
            $eduData = sqlGetDataWithParam('name', 'education', 'name', $education_name, $conn);
            if (empty($eduData)) {
                sqlInsertIntoValues('education', 'name', $education_name, $conn);
            }

            $schoolIdData = sqlGetDataWithParam('id', 'schools', 'name', $school_name, $conn);
            $schoolId = $schoolIdData['id'];
            $eduIdData = sqlGetDataWithParam('id', 'education', 'name', $education_name, $conn);
            $eduId = $eduIdData['id'];

            sqlInsertIntoValues('education_users', 'user_id,education_id,schools_id,started_at,finished_at',
                $user_id . ',' . $eduId . ',' . $schoolId . ',' . $edu_started_at . ',' . $edu_finished_at, $conn);
            header('location: /updateprofile');
        } else {
            header('location: /updateprofile');
        }
    }
}

if (isset($_POST['skillsSubmit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $skill_name = $_POST["skill_name"];
        $skill_level = $_POST["skill_level"];


        $rows = sqlCount("*", "skills_users", "user_id", $user_id, $conn);
        $rowsInt = $rows["count(*)"];

        if ($rowsInt < 5 and !empty($skill_name) and $skill_level > 0) {

            $data_skill_name = sqlGetDataWithParam('name', 'skills', 'name', $skill_name, $conn);
            if (empty($data_skill_name)) {
                sqlInsertIntoValues('skills', 'name', $skill_name, $conn);
            }
            $skill_idData = sqlGetDataWithParam('id', 'skills', 'name', $skill_name, $conn);
            $skill_id = $skill_idData['id'];
            sqlInsertIntoValues('skills_users', 'user_id,skill_id,skill_level', $user_id . ',' . $skill_id . ',' . $skill_level, $conn);
            header('location: /updateprofile');
        } else {
            header('location: /updateprofile');
        }
    }
}


