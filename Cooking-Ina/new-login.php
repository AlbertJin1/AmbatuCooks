<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/style-login-register.css">
    <title>signin-signup</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form action="#" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Email" id="login-email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="login-password">
                </div>
                <button type="button" class="btn" onclick="handleLogin()">Login</button>
                <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>
            <form action="#" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="name-field">
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="First Name" id="firstName">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Last Name" id="lastName">
                    </div>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" id="register-email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="register-password">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" id="confirmPassword">
                </div>
                <button type="button" class="btn" onclick="handleRegister()">Sign up</button>
                <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Already a User?</h3>
                    <p>Explore CookingIna's diverse range of Filipino recipes, designed to cater to both seasoned chefs
                        and beginners alike. Dive into traditional favorites and modern twists, all within a
                        user-friendly platform.</p>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
                <img src="img/Logo/CookingInalogoof.png" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>New to CookingIna?</h3>
                    <p>CookingIna is a Filipino cooking app that offers a variety of traditional and modern Filipino
                        recipes. Whether you're an experienced chef or a beginner, CookingIna provides a user-friendly
                        platform to explore and master the art of Filipino cuisine.</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
                <img src="img/Logo/CookingInalogoof.png" alt="" class="image">
            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
        import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
        import { getAuth, createUserWithEmailAndPassword, sendEmailVerification, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCW7W43zrdrBrF50yG2S6szorhMiWU2060",
            authDomain: "cooking-ina-mo.firebaseapp.com",
            projectId: "cooking-ina-mo",
            storageBucket: "cooking-ina-mo.appspot.com",
            messagingSenderId: "151249945282",
            appId: "1:151249945282:web:f5f7031dc3e1261489315b"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);

        const isEmailValid = (email) => {
            // Regular expression for email validation
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        };

        const handleLogin = () => {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            if (!email || !password) {
                Swal.fire({
                    icon: 'error',
                    title: 'Empty Fields',
                    text: 'Please fill in all the required input fields.'
                });
                return;
            }

            if (!isEmailValid(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.'
                });
                return;
            }

            signInWithEmailAndPassword(auth, email, password)
                .then((userCredential) => {
                    const user = userCredential.user;
                    if (user.emailVerified) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'You have successfully logged in.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reset input fields and navigate to home page
                            document.getElementById('login-email').value = '';
                            document.getElementById('login-password').value = '';
                            // Navigation code here
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Email Not Verified',
                            text: 'Please verify your email to log in.'
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: error.message
                    });
                });
        };

        // Function to handle registration
        const handleRegister = () => {
            // Get form input values
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Validation checks
            if (!firstName || !lastName || !email || !password || !confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Empty Fields',
                    text: 'Please fill in all the required input fields.'
                });
                return;
            }

            if (!isEmailValid(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.'
                });
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords Mismatch',
                    text: 'Password and Confirm Password do not match.'
                });
                return;
            }

            // Create user with email and password
            createUserWithEmailAndPassword(auth, email, password)
                .then((userCredential) => {
                    const user = userCredential.user;
                    // Add user data to Firestore database
                    const userRef = doc(db, "users", user.uid);
                    setDoc(
                        userRef,
                        {
                            firstName,
                            lastName,
                            email
                        },
                        { merge: true }
                    )
                        .then(() => {
                            // Registration successful
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Successful',
                                text: 'You have successfully registered.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Reset input fields and navigate to login page
                                document.getElementById('firstName').value = '';
                                document.getElementById('lastName').value = '';
                                document.getElementById('register-email').value = '';
                                document.getElementById('register-password').value = '';
                                document.getElementById('confirmPassword').value = '';
                                // Additional actions after successful registration
                            });
                        })
                        .catch((error) => {
                            console.error("Firestore error:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Registration Failed',
                                text: 'An error occurred during registration. Please try again later.'
                            });
                        });

                    // Send verification email
                    sendEmailVerification(user)
                        .then(() => {
                            console.log("Verification email sent");
                            // Show success message to the user
                            Swal.fire({
                                icon: 'success',
                                title: 'Check Your Email',
                                text: 'Please check your email for verification.'
                            });
                        })
                        .catch((error) => {
                            console.error("Email verification error:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Email Verification Failed',
                                text: 'An error occurred while sending the verification email. Please try again later.'
                            });
                        });
                })
                .catch((error) => {
                    // Registration failed
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: error.message
                    });
                });
        };
    </script>

    <script src="assets/script-new-login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>