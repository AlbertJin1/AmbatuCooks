<?php

session_start();

if (isset($_SESSION['usermail'])) {
    header('location:recipes-list.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ambatu Cooks - Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./img/ICON/ambatuicon.png" type="image/x-icon">

    <link rel="stylesheet" href="./assets/style-login.css">

</head>

<body class="gtp">

    <!-- <div class="video-background">
        <video id="dreamyvid" autoplay loop>
            <source src="./vid/moon river - dreamy.mp4" type="video/mp4">
        </video>
    </div> -->

    <div id="music">
        <audio id="bg-music" autoplay loop>
            <source src="./music/ogg/Evangelion - Tsubasa wo Kudasai.ogg" type="audio/ogg">
        </audio>
    </div>

    <div id="form-con" class="form-container">

        <form action="" method="post">
            <h1>
                <img src="./img/Logo/ambatulogoF.png" alt="logo">
            </h1>
            <h3>Pages</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <div class="pages">
                <a href="./index.php">Home</a>
                <a href="./recipes.php">Main Menu</a>
                <a href="./recipes-list.php">Courses</a>
                <a href="./login_form.php">login</a>
                <a href="./register_form.php">Register</a>
                <a href="./reset_password.php">Reset Password</a>
            </div>

        </form>

        <script>
            var myAudio = document.getElementById("bg-music");
            myAudio.volume = 0.15;
        </script>

    </div>

</body>

</html>