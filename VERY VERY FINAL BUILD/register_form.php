<?php

session_start();

// CHECK IF USER EXISTS
function isUsernameExists($username)
{
    $data = getUsersData();
    foreach ($data as $user) {
        if ($user['username'] === $username) {
            return true;
        }
    }
    return false;
}

// REGISTER NEW USER
function registerUser($firstName, $lastName, $username, $password)
{
    $data = getUsersData();
    $data[] = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'username' => $username,
        'password' => $password
    ];
    saveUsersData($data);
}

// RETRIEVE USER DATA FROM FILE
function getUsersData()
{
    $filePath = 'users.txt';
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        if (!empty($content)) {
            return unserialize($content);
        }
    }
    return [];
}

// SAVE USER DATA TO FILE
function saveUsersData($data)
{
    $filePath = 'users.txt';
    $content = serialize($data);
    file_put_contents($filePath, $content);
}

// REGISTER
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (isUsernameExists($username)) {
        $error[] = 'USER ALREADY EXISTS';
    } elseif ($password !== $cpassword) {
        $error[] = 'PASSWORDS DO NOT MATCH!';
    } else {
        registerUser($firstName, $lastName, $username, $password);
        echo '<script>alert("Registration successful! Please log in.");</script>';
        echo '<script>window.location.href = "login_form.php";</script>';
    }
}

if (isset($_SESSION['username'])) {
    header('location:recipes-list.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ambatu Cooks - Register</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/ICON/ambatuicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/style-login.css">

</head>

<body class="register">

    <div class="video-background">
        <video id="dreamyvid" autoplay loop playsinline>
            <source src="vid/dreamy.mp4" type="video/mp4">
        </video>
    </div>

    <div id="form-con" class="form-container">

        <form action="" method="post">
            <h1>
                <img src="img/Logo/ambatulogoF.png" alt="logo">
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
            <input type="text" name="username" placeholder="USERNAME" class="box" required>
            <input type="password" name="password" placeholder="PASSWORD" class="box" required>
            <input type="password" name="cpassword" placeholder="CONFIRM YOUR PASSWORD" class="box" required>
            <input type="submit" value="REGISTER NOW" name="submit" class="form-btn">
            <input type="reset" value="CLEAR" id="reset" class="form-btn">
            <div class="pages">
                <a class="goto-forms" href="go-to-page.php">Go to Page</a>
            </div>
            <p>ALREADY HAVE AN ACCOUNT? <a class="page" href="login_form.php">LOGIN NOW</a></p>

        </form>

        <script>
            var myVideo = document.getElementById("dreamyvid");
            myVideo.volume = 0.35;
        </script>

    </div>

</body>

</html>