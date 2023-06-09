<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['usermail'])){
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/style-login.css">

</head>

<body>
    
<div class="container">

    <div class="content">
        <h3>Welcome!</h3>
        <p>dsadaasddadad adasdasdasdasd adsadsadada adadas.adasdasda .adadas .asdasdasdada adasdsadas.</p>
        <p>YOUR EMAIL: <span><?php echo $_SESSION['usermail']; ?></span></p>
        <a href="index.php" class="continue">continue to website</a>
        <a href="logout.php" class="logout">logout</a>
    </div>

</div>

</body>
</html>