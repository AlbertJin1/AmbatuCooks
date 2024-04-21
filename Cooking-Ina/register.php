<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style-bootstrap-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script type="module" src="firebase-register.js" defer></script>

    <script>
        function togglePasswordVisibility(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var icon = document.getElementById(iconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">

                    <!-------------      image     ------------->

                    <img src="img/Logo/icon-cooking-ina.png" alt="">
                    <div class="text">
                        <p>There is a unique taste in every blend <i>- CookingIna</i></p>
                    </div>

                </div>

                <div class="col-md-6 right">

                    <div class="input-box">

                        <header>REGISTER</header>
                        <div class="text-sub">
                            <p>Enter your personal information</p>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="firstName" required autocomplete="off">
                            <label for="firstName">First Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="lastName" required autocomplete="off">
                            <label for="lastName">Last Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="email" required autocomplete="off">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-pass" id="password" required>
                            <label for="password">Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('password', 'eye-icon')">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </span>
                        </div>

                        <div class="input-field">
                            <input type="password" class="input-pass" id="confirmPassword" required>
                            <label for="confirmPassword">Confirm Password</label>
                            <span class="toggle-password"
                                onclick="togglePasswordVisibility('confirmPassword', 'eye-icon1')">
                                <i id="eye-icon1" class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="input-field">

                            <input type="submit" class="submit" value="Sign Up" id="registerButton">
                        </div>
                        <div class="signin">
                            <span>Already have an account? <a href="login.php">Login</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

</html>