<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
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
                <p>profile <hr class="line"></p>
                <form method="post" action="../updateProfileData.php">
                    <label for="file">Add profile picture</label>
                    <input type="file" accept="image/jpeg, image/png, image/svg" name="pfp" id="file">
                    <input type="text" placeholder="Add bio" name="bio">
                    <input type="submit" value="Save changes" id="button" name="profileSubmit">
                </form>
            </li>
            <li>
                <p>projects<hr class="line"></p>
                <form method="post" action="../updateProfileData.php">
                    <label for="file">Add project picture</label>
                    <input type="file" accept="image/jpeg, image/png, image/svg" name="project_image" id="file">
                    <input type="text" placeholder="Add link to project" name="project_link">
                    <input type="submit" value="Save changes" id="button" name="projectsSubmit">
                </form>
            </li>
            <li>
                <p>jobs<hr class="line"></p>
                <form method="post" action="../updateProfileData.php">
                    <input type="text" placeholder="Add job title" name="jobtitle">
                    <input type="text" placeholder="Add company" name="companyName">
                    <input type="date" name="job_started_at">
                    <input type="date" name="job_stopped_at">
                    <input type="submit" value="Save changes" id="button" name="jobsSubmit">
                </form>
            </li>
            <li>
                <p>education<hr class="line"></p>
                <form method="post" action="../updateProfileData.php">
                    <input type="text" placeholder="Add education name" name="education_name">
                    <input type="text" placeholder="Add school name" name="schoool_name">
                    <input type="date" name="edu_started_at">
                    <input type="date" name="edu_finished_at">
                    <input type="submit" value="Save changes" id="button" name="educationSubmit">
                </form>
            </li>
            <li>
                <p>skills<hr class="line"></p>
                <form method="post" action="../updateProfileData.php">
                    <input type="text" placeholder="Add skill name" name="skill_name">
                    <input type="text" placeholder="Add skill level 1 to 5" name="skill_level">
                    <input type="submit" value="Save changes" id="button" name="skillsSubmit">
                </form>
            </li>
        </ul>
    </article>
</main>
<?php require 'partials/footer/footer.php' ?>
</body>

</html>