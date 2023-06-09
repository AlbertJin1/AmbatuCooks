<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['usermail']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'USER ALREADY EXISTS';
    } else {
        if ($pass != $cpass) {
            $error[] = 'PASSWORDS DO NOT MATCH!';
        } else {
            $insert = "INSERT INTO user_form(firstName, lastName, email, password) VALUES('$firstName','$lastName','$email', '$pass')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
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

    <script>
        $('.page').on('click', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('#form-con').load(url);
        });
    </script>

</head>

<body class="register">

    <div class="video-background">
        <video id="dreamyvid" autoplay loop>
            <source src="./vid/dreamy.mp4" type="video/mp4">
        </video>
    </div>

    <div id="form-con" class="form-container">

        <form action="" method="post">
            <h1>
                <img src="./img/Logo/ambatulogoF.png" alt="logo">
            </h1>
            <h3>register</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="text" name="firstName" placeholder="FIRST NAME" class="box" required>
            <input type="text" name="lastName" placeholder="LAST NAME" class="box" required>
            <input type="email" name="usermail" placeholder="EMAIL" class="box" required>
            <input type="password" name="password" placeholder="PASSWORD" class="box" required>
            <input type="password" name="cpassword" placeholder="CONFIRM YOUR PASSWORD" class="box" required>
            <input type="submit" value="REGISTER NOW" name="submit" class="form-btn">
            <input type="reset" value="CLEAR" id="reset" class="form-btn">
            <p>ALREADY HAVE AN ACCOUNT? <a class="page" href="login_form.php">LOGIN NOW</a></p>

        </form>

        <script>
            var myVideo = document.getElementById("dreamyvid");
            myVideo.volume = 0.35;
        </script>

    </div>

</body>

</html>