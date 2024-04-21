<?php

require 'pages/1.index/1.index-php-com.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require 'pages/1.index/2.index-head.php';
    ?>

</head>

<body onload="checkLoginStatus()">

    <div class="loader">
        <!-- <video autoplay muted loop>
            <source src="./vid/background-load.mp4" type="video/mp4">
        </video> -->
        <!-- <h1>Loading...</h1> -->
        <!-- <img src="./img/loader/loading-loader.gif" alt="loader gif"> -->
    </div>


    <div id="progress">
        <span id="progress-value">▲</span>
    </div>

    <div id="music">
        <audio id="bg-music" autoplay loop>
            <!-- <source src="./music/ogg/on a clear day (kiki's delivery service lofi).ogg" type="audio/ogg"> -->
        </audio>
    </div>

    <header>

        <?php
        include 'pages/1.index/3.index-header.php';
        ?>

    </header>

    <?php

    include 'pages/1.index/4.index-home.php';
    include 'pages/1.index/5.index-about-gallery.php';
    include 'pages/1.index/6.index-team-review.php';
    include 'pages/1.index/7.index-blogs-contact.php';
    include 'pages/1.index/8.index-quote-footer.php';
    require 'pages/1.index/9.index-foot-scripts.php';

    ?>

</body>

</html>