<?php
include('includes/header.inc.php');
// include('includes/hamburger.inc.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>About page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\about.css">
</head>

<body>
    <main class="container">
        <div class="main">
            <?php createHeader(); ?>
            <?php include('includes/hamburger.inc.php'); ?>
            <!-- Description of the Site -->
            <div class="aboutInfo">
                <h1>COMP_3512 Web Development II (Fall 2019)</h1>
                <h3>Mount Royal University</h3>
                <h3>Professor: Randy Connolly</h3>
                <p>Technologies: HTML, CSS, PHP, JS, and GIT</p>
                <h4>Group Members:</h4>
                <ul>
                    <li>Peter M.</li>
                    <li>Yuna S.</li>
                    <li>Stefan M.</li>
                </ul>
                <a href="https://github.com/StefanKristoff/Web2Assignment2.git"> Main github page link</a>

            </div>

        </div>
    </main>
</body>

</html>