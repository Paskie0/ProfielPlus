<html lang="en">

<head>
    <?php
    require 'partials/head.php';
    $conn = require 'functions/connection.php';
    require 'functions/sqlfunctions.php';
    ?>
    <link rel="stylesheet" href="../views/partials/css/updateProfile.css"/>
    <script src="../views/partials/javascript/updateProfile.js"></script>
</head>

<body>
<?php require 'partials/header/header.php' ?>
<main>
    <aside>
        <nav>
            nav
        </nav>
    </aside>
    <article>
        <ul>
            <li>
                <p>Profile
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php">
                        <label for="file">Add profile picture</label>
                        <input type="file" accept="image/jpeg, image/png, image/svg" name="pfp" id="file">
                        <input type="text" placeholder="Add bio" name="bio">
                        <input type="submit" value="Save changes" id="button" name="profileSubmit">
                    </form>
                </div>
            </li>
            <li>
                <p>Projects
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php">
                        <label for="file">Add project picture</label>
                        <input type="text" placeholder="Add project name" name="project_name">
                        <input type="file" accept="image/jpeg, image/png, image/svg" name="project_image" id="file">
                        <input type="text" placeholder="Add link to project" name="project_link">
                        <input type="submit" value="Save changes" id="button" name="projectsSubmit">
                    </form>
                    <ul class="dataDis">
                        <?php
                        $projectNameData = sqlGetDataWithParamAll('project_name,id', 'projects', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($projectNameData as $projectName) {
                            $link = "http://". $_SERVER['HTTP_HOST'] . "/deleteItems.php?table=projects&id=" . $projectName['id'];
                            echo '<li><div>' . $projectName['project_name'] . '</div><div class="xButton"><a href="'.$link . '"><img src="../images/delete.svg"></a></div></li>';
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li>
                <p>Jobs
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php">
                        <input type="text" placeholder="Add job title" name="jobtitle">
                        <input type="text" placeholder="Add company" name="companyName">
                        <input type="date" name="job_started_at">
                        <input type="date" name="job_stopped_at">
                        <input type="submit" value="Save changes" id="button" name="jobsSubmit">
                    </form>
                    <ul  class="dataDis">
                        <?php
                        $datajobs = sqlGetDataWithParamAll('job_id,id', 'jobs_users', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($datajobs as $datajob) {
                            $jobName = sqlGetDataWithParam('name', 'jobs', 'id', $datajob['job_id'], $conn);
                            $link = "http://". $_SERVER['HTTP_HOST'] . "/deleteItems.php?table=jobs_users&id=" . $datajob['id'];
                            echo '<li><div>' . $jobName['name'] . '</div><div class="xButton"><a href="'.$link.'"><img src="../images/delete.svg"></a></div></li>';
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li>
                <p>Education
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php">
                        <input type="text" placeholder="Add education name" name="education_name">
                        <input type="text" placeholder="Add school name" name="school_name">
                        <input type="date" name="edu_started_at">
                        <input type="date" name="edu_finished_at">
                        <input type="submit" value="Save changes" id="button" name="educationSubmit">
                    </form>
                    <ul  class="dataDis">
                        <?php
                        $dataEdus = sqlGetDataWithParamAll('education_id,id', 'education_users', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($dataEdus as $dataEdu) {
                            $eduName = sqlGetDataWithParam('name', 'education', 'id', $dataEdu['education_id'], $conn);
                            $link = "http://". $_SERVER['HTTP_HOST'] . "/deleteItems.php?table=education_users&id=" . $dataEdu['id'];
                            echo '<li><div>' . $eduName['name'] . '</div><div class="xButton"><a href="'.$link.'"><img src="../images/delete.svg"></a></div></li>';
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li>
                <p>Skills
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php">
                        <input type="text" placeholder="Add skill name" name="skill_name">
                        <input type="number" min="1" step="1" max="5" placeholder="Add skill level 1 to 5"
                               name="skill_level">
                        <input type="submit" value="Save changes" id="button" name="skillsSubmit">
                    </form>
                    <ul  class="dataDis">
                        <?php
                        $dataSkills = sqlGetDataWithParamAll('skill_id,id', 'skills_users', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($dataSkills as $dataSkill) {
                            $skillName = sqlGetDataWithParam('name', 'skills', 'id', $dataSkill['skill_id'], $conn);
                            $link = "http://". $_SERVER['HTTP_HOST'] . "/deleteItems.php?table=skills_users&id=" . $dataSkill['id'];
                            echo '<li><div>' . $skillName['name'] . '</div><div class="xButton"><a href="'.$link.'"><img src="../images/delete.svg"></a></div></li>';
                        }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>
    </article>
</main>
<?php require 'partials/footer/footer.php' ?>
</body>

</html>