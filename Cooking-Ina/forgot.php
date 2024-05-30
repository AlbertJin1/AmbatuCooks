<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | CookingIna</title>
    <link rel="icon" href="./img/ICON/icon-cooking-ina.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/style-bootstrap-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script type="module" src="firebase-reset.js" defer></script>
</head>

<body>
    <div id="loader" class="loader">
        <div class="loader-spinner"></div>
    </div>

    <video autoplay muted loop id="bg-video">
        <source src="vid/bg-green.mp4" type="video/mp4">
    </video>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">

                    <!-------------      image     ------------->

                    <img src="img/Logo/icon-cooking-ina.png" alt="">
                    <div class="text">
                        <p>Eat | Play | Sleep</p>
                        <i>- CookingIna -</i>
                    </div>

                </div>

                <div class="col-md-6 right">

                    <div class="input-box">

                        <header>RESET PASSWORD</header>
                        <div class="text-sub">
                            <p>We got you covered</p>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="email" required autocomplete="off">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">

                            <input type="submit" class="submit" value="Reset" id="forgotPasswordButton">
                        </div>
                        <div class="signin1">
                            <a href="login.php">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Hide the loader when the content is fully loaded
            var loader = document.getElementById("loader");
            loader.classList.add("loader--hidden");
        });
    </script>
</body>

</html>