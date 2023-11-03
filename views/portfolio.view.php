<html lang="en">

<head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="../views/partials/css/portfolio.css" />
</head>
<body>
<!--header staat als een partial dus ik op elke pagina get zelfde is en makkelijk aan te passen-->
    <?php require 'partials/header/header.php' ?>
    <main>
<!--        De pagina is in 2 kanten opgedeeld. de linkerkant is weer opgedeeld in 2 rijen. de bovenste rij is het profielsegment-->
        <div id="profile">
            <div id="pfp">
                <img src="../<?php echo $pfp?>" alt="test">
            </div>
            <div id="name">
                <div>
                    <span><?= $firstName . " " . $lastName ?></span>
                    <span><?= $jobTitle ?></span>
                </div>
            </div>
            <div id="socials">
            </div>
            <div id="bio">
                <p><?= $bio ?></p>
            </div>
        </div>
        <!--        dit is de onderste rij van de derde kant. hier hebben we 3 soortgelijken elementen die met soortgelijke data gevuld zijn
de drie elementen zijn hier opgemaakt als skills, opleiding en werkervaring en-->
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
                    $eduId = $education['education_id'];
                    $schoolIdData = sqlGetDataWithParam('schools_id,started_at,finished_at', 'education_users', 'education_id', $eduId, $conn);
                    $schoolNameData = sqlGetDataWithParam('name', 'schools', 'id', $schoolIdData['schools_id'], $conn);
                    $started_at = $schoolIdData['started_at'];
                    $finished_at = $schoolIdData['finished_at'];
                    echo "<li>" . $education['education_name'] . "<p>".$schoolNameData['name']."</p><p>".$started_at." : ".$finished_at."</p></li>";
                } ?>
            </ul>
        </div>
        <div id="cv">
            <span>Werkervaring</span>
            <ul>
                <?php
                $jobInfo = [];
                foreach ($jobsData as $job) {
                    $jobId = $job['job_id'];
                    $companyIdData = sqlGetDataWithParam('company_id,started_at,stopped_at', 'jobs_users', 'job_id', $jobId, $conn);
                    $companyNameData = sqlGetDataWithParam('name', 'companies', 'id', $companyIdData['company_id'], $conn);
                    if ($companyIdData['stopped_at'] == '0000-00-00'){
                        $stopped_at = 'Present';
                    }else{
                        $stopped_at = $companyIdData['stopped_at'];
                    }
                    $started_at = $companyIdData['started_at'];
                    echo "<li class='jobElement'>" . $job['job_name'] . "<p>".$companyNameData['name']."</p><p>".$started_at." : ".$stopped_at."</p></li>";
                } ?>
            </ul>
        </div>
<!--        als laatste segment ziojn de projecten. dit is de hoofdfunctie van het project een heeft daarom ook het grootste segment.-->
        <div id="projects">
            <?php foreach ($projectsData as $project) {
                $imgData = $project['project_img'];
                $binaryData = base64_decode($imgData);
                $img = imagecreatefromstring($binaryData);
                $filename = $project['project_name'] . "_img";
                imagejpeg($img, $filename);
                $projectImage = $filename;
                imagedestroy($img);

                echo "<div><span>" . $project['project_name'] . "</span>";
                echo "<a href='". $project['project_link']."' target='_blank'><img src='../" .$projectImage ."' alt='test'></a>";
            } ?>

        </div>
    </main>
<!--ook de footer staat in een partial zodat deze overal hetzelfde is en makkelijk is aan te passen-->
    <?php require 'partials/footer/footer.php' ?>
</body>

</html>