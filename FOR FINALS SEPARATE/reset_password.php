<?php

session_start();

// RETRIEVE USER DATA BY USERNAME
function getUserDataByUsername($username)
{
    $data = getUsersData();
    foreach ($data as $user) {
        if ($user['username'] === $username) {
            return $user;
        }
    }
    return null;
}

// UPDATE USER PASSWORD
function updateUserPassword($username, $newPassword)
{
    $data = getUsersData();
    foreach ($data as &$user) {
        if ($user['username'] === $username) {
            $user['last_password'] = $user['password'];
            $user['password'] = $newPassword;
            break;
        }
    }
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

// RESET
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Retrieve user data
    $userData = getUserDataByUsername($username);

    if ($userData) {
        if ($newPassword !== $confirmPassword) {
            $error[] = 'PASSWORDS DO NOT MATCH!';
        } else if ($newPassword === $userData['password']) {
            $error[] = 'CANNOT SET THE SAME PASSWORD AS THE PREVIOUS ONE!';
        } else {
            // Update user's password
            updateUserPassword($username, $newPassword);
            echo '<script>alert("Reset password successful! Please log in.");</script>';
            echo '<script>window.location.href = "login_form.php";</script>';
        }
    } else {
        $error[] = 'INVALID USERNAME!';
    }
}

// IF USER IS ALREADY LOGGED IN = REDIRECT TO COURSES
if (isset($_SESSION['username'])) {
    header('location:recipes-list.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ambatu Cooks - Reset Password</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/ICON/ambatuicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/style-login.css">

</head>

<body class="reset">

    <div class="video-background">
        <video id="dreamyvid" autoplay loop>
            <source src="vid/dreamdream.mp4" type="video/mp4">
        </video>
    </div>

    <div id="form-con" class="form-container">

        <form action="" method="post">
            <h1>
                <img src="img/Logo/ambatulogoF.png" alt="logo">
            </h1>
            <h3>reset password</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="text" name="username" placeholder="USERNAME" class="box" required>
            <input type="password" name="new_password" placeholder="NEW PASSWORD" class="box" required>
            <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" class="box" required>
            <input type="submit" value="RESET PASSWORD" name="submit" class="form-btn">
            <input type="reset" value="CLEAR" id="reset" class="form-btn">
            <div class="pages" id="pages-form">
                <a class="goto-forms" href="go-to-page.php">Go to Page</a>
            </div>

        </form>

        <script>
            var myVideo = document.getElementById("dreamyvid");
            myVideo.volume = 0.25;
        </script>

    </div>

</body>

</html>