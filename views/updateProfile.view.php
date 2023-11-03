<html lang="en">

<head>
    <?php
    require 'partials/head.php';
    $conn = require 'functions/connection.php';
    require 'functions/sqlfunctions.php';
    ?>
    <link rel="stylesheet" href="../views/partials/css/updateProfile.css"/>
    <script src="../views/scroll.js"></script>
</head>

<body>
<?php require 'partials/header/header.php' ?>
<main>
<!--    deze pagina is in 2 delen ingedeeld. link een kleine navigatie en rechts het hoofdgedeelte.-->
    <aside>
<!--        hier hebben we een kleine navigatie die wanner er op geclicked wordt naar het juiste deel van de pagina gescrolled
hier hebben we voor gekozen om het overzicht van de pagina te behouden en de gebruiken een makkelijke manier te geven om snel naar
de het juiste deel te gaan.-->
        <nav>
            <ul>
                <li>Navigation<hr class="line"></li>
                <li class="navElement" onclick="goTo(72)">Profile</li>
                <li class="navElement" onclick="goTo(307)">Projects</li>
                <li class="navElement" onclick="goTo(572)">Jobs</li>
                <li class="navElement" onclick="goTo(838)">Education</li>
                <li class="navElement" onclick="goTo(838)">Skills</li>
            </ul>
        </nav>
    </aside>
    <article>
        <ul>
<!--            de rechterkant van de pagina is het hoofddeel van deze pagina. we hebben ervoor gekozen om dit in 5 rijen met categorien te doen
dit hebben we om 2 redenen gedaan. de eerste reden is performance. op deze manier zetten wij een klein limiet op de hoeveel heid
data dat een gebruiker in 1x naar de database kan sturen. dit houdt de pagina snel en responsive. de tweede reden is overzicht. er kan veel data op worden ingevuld
maar zodra de gebruiken zijn portfolio heeft ingericht zal deze pagina voornamlijk worden gebruikt voor kleine aanpassingen. door deze kant in stukken op te delen
kan de gebruiken snel zien waar hij de data moet invullen-->
            <li>
                <p>Profile
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php" enctype="multipart/form-data">
                        <label for="file">Add profile picture</label><div></div>
                        <input type="file" accept="image/jpeg" name="pfp" id="file"><div></div>
                        <input type="text" placeholder="Add bio" name="bio"><div></div>
                        <input type="submit" value="Save changes" id="button" name="profileSubmit"><div></div>
                    </form>
                </div>
            </li>
            <li>
                <p>Projects
                <hr class="line">
                </p>
                <div>
                    <form method="post" action="../updateProfileData.php" enctype="multipart/form-data">
                        <input type="text" placeholder="Add project name" name="project_name"><div>*</div>
                        <label for="file">Add project picture</label><div></div>
                        <input type="file" accept="image/jpeg, image/png, image/svg" name="project_image" id="file"><div>*</div>
                        <input type="text" placeholder="Add link to project" name="project_link"><div>*</div>
                        <input type="submit" value="Save changes" id="button" name="projectsSubmit"><div></div>
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
                        <input type="text" placeholder="Add job title" name="jobtitle"><div>*</div>
                        <input type="text" placeholder="Add company" name="companyName"><div>*</div>
                        <input type="date" name="job_started_at"><div>*</div>
                        <input type="date" name="job_stopped_at"><div></div>
                        <input type="submit" value="Save changes" id="button" name="jobsSubmit"><div></div>
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
                        <input type="text" placeholder="Add education name" name="education_name"><div>*</div>
                        <input type="text" placeholder="Add school name" name="school_name"><div>*</div>
                        <input type="date" name="edu_started_at"><div>*</div>
                        <input type="date" name="edu_finished_at"><div>*</div>
                        <input type="submit" value="Save changes" id="button" name="educationSubmit"><div></div>
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
                        <input type="text" placeholder="Add skill name" name="skill_name"><div>*</div>
                        <input type="number" min="1" step="1" max="5" placeholder="Add skill level 1 to 5"
                               name="skill_level"><div>*</div>
                        <input type="submit" value="Save changes" id="button" name="skillsSubmit"><div></div>
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