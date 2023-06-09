<?php

require 'pages/3.courses/1.recipeslist-php-com.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require 'pages/3.courses/2.recipeslist-head.php';

    ?>

</head>

<body>

    <div class="loader">
        <!-- <video autoplay muted loop>
            <source src="./vid/background-load.mp4" type="video/mp4">
        </video> -->
        <!-- <h1>Loading...</h1> -->
        <img src="./img/loader/loading-loader.gif" alt="loader gif">
    </div>

    <div id="progress">
        <span id="progress-value">▲</span>
    </div>

    <!-- <audio id="bg-ambatu" autoplay>
        <source src="./music/ogg/AMBATUKAM.ogg">
    </audio> -->

    <div id="music">
        <audio id="bg-music" volume="0.5" autoplay loop>
            <source src="./music/ogg/signal flags (from up on poppy hill lofi).ogg" type="audio/ogg">
        </audio>
    </div>

    <header>

        <?php

        require 'pages/3.courses/3.recipeslist-header.php';

        ?>

    </header>

    <!-- <section class="space"></section> -->

    <section class="video">
        <h2>Cooking is like love</h2>
        <h1>it should be entered into with abandon or not at all</h1>
        <div class="video-wrapper">
            <video autoplay loop muted>
                <source src="./vid/1-cooking-anime.mp4">
            </video>

            <div class="video-gradient-overlay"></div>
        </div>
    </section>

    <?php

    include 'pages/3.courses/4.recipeslist-main.php';
    include 'pages/3.courses/5.recipeslist-quote-appe.php';
    include 'pages/3.courses/6.recipeslist-quote-desserts.php';
    include 'pages/3.courses/7.recipeslist-quote-beve.php';
    include 'pages/3.courses/8.recipeslist-quote-footer.php';
    include 'pages/3.courses/9.recipeslist-foot-scripts.php';

    ?>
    
</body>

</html>