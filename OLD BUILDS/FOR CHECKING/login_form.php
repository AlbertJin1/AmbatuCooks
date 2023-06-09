<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['usermail']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['usermail'] = $email;
        header('location:index.php');
    } else {
        $error[] = 'INCORRECT EMAIL OR PASSWORD';
    }
}

if (isset($_SESSION['usermail'])) {
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ambatu Cooks - Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/style-login.css">

</head>

<body class="login">

    <div class="video-background">
        <video id="dreamyvid" autoplay loop>
            <source src="./vid/moon river - dreamy.mp4" type="video/mp4">
        </video>
    </div>

    <div id="form-con" class="form-container">

        <form action="" method="post">
            <h1>
                <img src="./img/Logo/ambatulogoF.png" alt="logo">
            </h1>
            <h3>login</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="email" name="usermail" placeholder="EMAIL" class="box" required>
            <input type="password" name="password" placeholder="PASSWORD" class="box" required>
            <input type="submit" value="LOGIN NOW" name="submit" class="form-btn">
            <input type="reset" value="CLEAR" id="reset" class="form-btn">
            <p>DON'T HAVE AN ACCOUNT? <a class="page" href="register_form.php">REGISTER NOW</a></p>

        </form>

        <script>
            var myVideo = document.getElementById("dreamyvid");
            myVideo.volume = 0.25;
        </script>

    </div>

</body>

</html>