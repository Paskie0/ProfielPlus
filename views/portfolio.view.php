<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/portfolio.css" />
</head>

<body>
    <?php require 'partials/header/header.php' ?>
    <main>
        <div id="profile">
            <div id="pfp">
                <img src="" alt="picture">
            </div>
            <div id="name">
                <div>
                    <span><?= $firstName . " " . $lastName ?></span>
                    <span><?= $user_id ?></span>
                </div>
            </div>
            <div id="socials">
            </div>
            <div id="bio">
                <p><?= $bio ?></p>
            </div>
        </div>
        <div id="skills">
            <span>Skills (1-5)</span>
            <ul>
                <?php foreach ($skillsData as $skill) {
                    echo "<li>" . $skill['skill_name'] . " (" . $skill['skill_level'] . ")" . "</li>";
                } ?>
            </ul>
        </div>
        <div id="education">
            <span>Opleiding</span>
            <ul>
                <?php foreach ($educationData as $education) {
                    echo "<li>" . $education['education_name'] . "</li>";
                } ?>
            </ul>
        </div>
        <div id="cv">
            <span>Werkervaring</span>
            <ul>
                <?php foreach ($jobsData as $job) {
                    echo "<li>" . $job['job_name'] . "</li>";
                } ?>
            </ul>
        </div>
        <div id="projects">
            <?php foreach ($projectsData as $project) {
                echo "<div><span>" . $project['project_name'] . "</span>";
                echo "<img src='" . $project['project_img'] . "' alt=''>";
                echo "<a href='" . $project['project_link'] . "'></a></div>";
            } ?>

        </div>
    </main>
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>