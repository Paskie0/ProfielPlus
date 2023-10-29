<html lang="en">

<head>
    <?php
    require 'partials/head.php';
    $conn = require 'functions/connection.php';
    require 'functions/sqlfunctions.php';
    //    session_start();
    ?>
    <link rel="stylesheet" href="../views/partials/css/updateProfile.css"/>
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
                    <ul>
                        <?php
                        $projectNameData = sqlGetDataWithParamAll('project_name', 'projects', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($projectNameData as $projectName) {
                            echo '<li><div>' . $projectName['project_name'] . '</div><div>x</div></li>';
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
                    <ul>
                        <?php
                        $datajobs = sqlGetDataWithParamAll('job_id', 'jobs_users', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($datajobs as $datajob) {
                            $jobName = sqlGetDataWithParam('name', 'jobs', 'id', $datajob['job_id'], $conn);
                            echo '<li><div>' . $jobName['name'] . '</div><div>x</div></li>';
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
                    <ul>
                        <?php
                        $dataEdus = sqlGetDataWithParamAll('education_id', 'education_users', 'user_id', $_SESSION["user_id"], $conn);
                        foreach ($dataEdus as $dataEdu) {
                            $eduName = sqlGetDataWithParam('name', 'education', 'id', $dataEdu['education_id'], $conn);
                            echo '<li><div>' . $eduName['name'] . '</div><div>x</div></li>';
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
                    <ul id="skillList">
                        <li>
                            <?php
                            $dataSkills = sqlGetDataWithParamAll('skill_id', 'skills_users', 'user_id', $_SESSION["user_id"], $conn);
                            if (isset($dataSkills[0])) {
                                $dataRow = $dataSkills[0];
                                $skillNameData = sqlGetDataWithParam('name', 'skills', 'id', $dataRow['skill_id'], $conn);
                                $skillName = $skillNameData['name'];
                                echo '<div>' . $skillName . '</div><div>x</div>';
                            } else {
                                echo '<div>empty</div><div></div>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($dataSkills[1])) {
                                $dataRow = $dataSkills[1];
                                $skillNameData = sqlGetDataWithParam('name', 'skills', 'id', $dataRow['skill_id'], $conn);
                                $skillName = $skillNameData['name'];
                                echo '<div>' . $skillName . '</div><div>x</div>';
                            } else {
                                echo '<div>empty</div><div></div>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($dataSkills[2])) {
                                $dataRow = $dataSkills[2];
                                $skillNameData = sqlGetDataWithParam('name', 'skills', 'id', $dataRow['skill_id'], $conn);
                                $skillName = $skillNameData['name'];
                                echo '<div>' . $skillName . '</div><div>x</div>';
                            } else {
                                echo '<div>empty</div><div></div>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($dataSkills[3])) {
                                $dataRow = $dataSkills[3];
                                $skillNameData = sqlGetDataWithParam('name', 'skills', 'id', $dataRow['skill_id'], $conn);
                                $skillName = $skillNameData['name'];
                                echo '<div>' . $skillName . '</div><div>x</div>';
                            } else {
                                echo '<div>empty</div><div></div>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($dataSkills[4])) {
                                $dataRow = $dataSkills[4];
                                $skillNameData = sqlGetDataWithParam('name', 'skills', 'id', $dataRow['skill_id'], $conn);
                                $skillName = $skillNameData['name'];
                                echo '<div>' . $skillName . '</div><div>x</div>';
                            } else {
                                echo '<div>empty</div><div></div>';
                            }
                            ?>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
    </article>
</main>
<?php require 'partials/footer/footer.php' ?>
</body>

</html>