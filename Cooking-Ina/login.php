<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style-bootstrap-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script type="module" src="firebase-login.js" defer></script>
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
                        <p>Cooking is like magic <i>- CookingIna</i></p>
                    </div>

                </div>

                <div class="col-md-6 right">

                    <div class="input-box">

                        <header>LOGIN</header>
                        <div class="text-sub">
                            <p>Login to continue browsing recipes</p>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="email" required autocomplete="off">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="password" required>
                            <label for="password">Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('password', 'eye-icon')">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="input-field">

                            <a class="forgotpass" href="forgot.php">Forgot Password?</a>
                        </div>
                        <div class="input-field">

                            <input type="submit" class="submit" value="Sign In" id="loginButton">
                        </div>
                        <div class="signin">
                            <span>Don't have an account? <a href="register.php">Register</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>