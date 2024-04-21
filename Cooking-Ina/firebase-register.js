import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
import { getAuth, createUserWithEmailAndPassword, sendEmailVerification, } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";

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



const submit = document.getElementById('registerButton');
submit.addEventListener("click", function (event) {
    event.preventDefault();

    // Function to validate email using regex
    function isEmailValid(email) {
        const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return regex.test(email);
    }

    // Function to validate password using regex
    function isPasswordValid(password) {
        const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
        return regex.test(password);
    }

    // Retrieve input values
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Error handling
    if (!firstName || !lastName || !email || !password || !confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
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

    if (!isPasswordValid(password)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: 'Password must contain at least one lowercase letter, one uppercase letter, one numeric digit, one special character, and be between 8 and 15 characters in length.'
        });
        return;
    }

    if (password !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Password Mismatch',
            text: 'The passwords do not match.'
        });
        return;
    }

    // Perform registration and save data to Firestore
    createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            const user = userCredential.user;

            // Send verification email
            sendEmailVerification(auth.currentUser)
                .then(() => {
                    console.log("Verification email sent");
                    Swal.fire({
                        icon: 'success',
                        title: 'Verification Email Sent',
                        text: 'Please check your email for verification.'
                    });
                })
                .catch((error) => {
                    console.error("Email verification error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while sending the verification email. Please try again later.'
                    });
                });

            // Save user data to Firestore
            const userRef = doc(db, "users", user.uid);
            setDoc(
                userRef,
                {
                    firstName,
                    lastName,
                    email,
                },
                { merge: true }
            )
                .then(() => {
                    console.log("User information stored in Firestore");
                    Swal.fire({
                        icon: 'success',
                        title: 'Account Created',
                        text: 'Your account has been created successfully!'
                    }).then(() => {
                        window.location.href = "login.php";
                    });
                })
                .catch((error) => {
                    console.error("Firestore error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while creating your account. Please try again later.'
                    });
                });
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            if (errorCode === "auth/email-already-in-use") {
                Swal.fire({
                    icon: 'error',
                    title: 'Email Already in Use',
                    text: 'The email address is already registered. Please use a different email.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        });
});