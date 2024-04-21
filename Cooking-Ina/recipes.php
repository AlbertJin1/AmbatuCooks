<?php

require 'pages/2.main-menu/1.recipes-php-com.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require 'pages/2.main-menu/2.recipes-head.php';

    ?>

</head>

<body>

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
            <!-- <source src="./music/ogg/merry-go-round of life (howl's moving castle lofi).ogg" type="audio/ogg"> -->
        </audio>
    </div>

    <!-- <audio id="bg-ambatu" autoplay>
        <source src="./music/ogg/ambatublow.ogg" type="audio/ogg">
    </audio> -->

    <header>

        <?php

        require 'pages/2.main-menu/3.recipes-header.php';

        ?>

    </header>

    <!-- <section class="space"></section> -->

    <section class="video">
        <h2>Cooking is like love</h2>
        <h1>it should be entered into with abandon or not at all</h1>
        <div class="video-wrapper">
            <video autoplay loop muted playsinline>
                <source src="./vid/3-cooking-anime.mp4">
            </video>

            <div class="video-gradient-overlay"></div>
        </div>
    </section>

    <?php

    include 'pages/2.main-menu/4.recipes-blogs.php';
    include 'pages/2.main-menu/5.recipes-category.php';
    include 'pages/2.main-menu/6.recipes-quote-footer.php';
    require 'pages/2.main-menu/7.recipes-foot-scripts.php';

    ?>

</body>

</html>